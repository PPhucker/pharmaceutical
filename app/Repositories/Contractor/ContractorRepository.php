<?php

namespace App\Repositories\Contractor;

use App\Models\Contractor\Contractor;
use App\Repositories\ResourceRepository;
use DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Репозиторий для контрагента.
 */
class ContractorRepository extends ResourceRepository
{
    /**
     * @param bool $withTrashed
     *
     * @return Collection
     */
    public function getAll(bool $withTrashed = false): Collection
    {
        $contractors = $this->clone()
            ->select([
                'id',
                'legal_form_type',
                'name',
                'INN',
                'OKPO',
                'contacts',
                'comment',
                'kpp',
                'deleted_at',
            ]);

        if ($withTrashed) {
            $contractors->withTrashed();
        }

        return $contractors
            ->with([
                'legalForm:abbreviation',
                'contracts' => function ($query) {
                    $query->with([
                        'organization:id,legal_form_type,name'
                    ])
                        ->withoutTrashed()
                        ->where('is_valid', 1)
                        ->where('organization_id', '=', session('organization_id'))
                        ->orderBy('date');
                }
            ])
            ->get()
            ->map(function ($contractor) {
                $contractor->contracts->each(function ($contract) {
                    $contract->is_expired = $contract->isExpired();
                });
                return $contractor;
            })
            ->sortBy('full_name')
            ->sortByDesc(
                function ($contractor) {
                    return [$contractor->contracts->count()];
                }
            );
    }

    /**
     * Получить юридический адрес контрагента.
     *
     * @param int $id
     *
     * @return \Illuminate\Support\Collection|null
     */
    public function getRegisteredAddress(int $id): ?\Illuminate\Support\Collection
    {
        $registered = $this->clone()
            ->find($id)
            ->placesOfBusiness()
            ->where('registered', 1)
            ->first();

        if (!$registered) {
            return null;
        }
        return collect(
            [
                'index' => $registered->index,
                'address' => $registered->address,
            ]
        );
    }

    /**
     * Статистика продаж продукта по контрагентам.
     *
     * @param int $productCatalogId
     * @param array $filters
     *
     * @return Collection
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function productCatalogSaleStatistic(int $productCatalogId, array $filters): Collection
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $filters['start_date']);
        $endDate = Carbon::createFromFormat('Y-m-d', $filters['end_date']);

        return $this->clone()
            ->with(['packingLists.production'])
            ->whereHas('packingLists', function ($query) use ($productCatalogId, $startDate, $endDate) {
                $query->where('approved', 1)
                    ->whereBetween('date', [$startDate, $endDate])
                    ->whereHas('production', function ($subQuery) use ($productCatalogId) {
                        $subQuery->where('product_id', $productCatalogId);
                    });
            })
            ->get();
    }

    /**
     * Получить список покупателей на период по продажам.
     *
     * @param array $between Массив, содержащий начальную и конечную дату периода.
     * @param int   $take    Количество возвращаемых покупателей (по умолчанию 10).
     *
     * @return Collection
     */
    public function getCustomersForPeriodBySales(array $between, int $take = 10): Collection
    {
        $totalSalesQuery = 'SUM(documents_shipment_packing_lists_production.price
            * documents_shipment_packing_lists_production.quantity)
            as total_sales';

        return $this->model->select([
            'id',
            'name',
            'legal_form_type',
            DB::raw($totalSalesQuery)
        ])
            ->withoutTrashed()
            ->join(
                'documents_shipment_packing_lists',
                'documents_shipment_packing_lists.contractor_id',
                '=',
                'contractors.id'
            )
            ->whereBetween('documents_shipment_packing_lists.date', $between)
            ->join(
                'documents_shipment_packing_lists_production',
                'documents_shipment_packing_lists_production.packing_list_id',
                '=',
                'documents_shipment_packing_lists.id'
            )
            ->groupBy('contractors.id', 'contractors.name', 'contractors.legal_form_type')
            ->orderBy('total_sales', 'desc')
            ->take($take)
            ->get();
    }

    /**
     * @param int $id
     *
     * @return Contractor
     */
    public function getForEdit(int $id): Contractor
    {
        $contractor = $this->model::findOrFail($id);

        $contractor->load(
            [
                'legalForm' => static function ($query) {
                    $query->select('classifier_legal_forms.abbreviation')
                        ->orderBy('abbreviation');
                },
                'placesOfBusiness' => static function ($query) {
                    $query->orderBy('deleted_at')
                        ->orderByDesc('contractors_places_of_business.registered')
                        ->orderByDesc('contractors_places_of_business.address')
                        ->with('region');
                },
                'bankAccountDetails' => static function ($query) {
                    $query->orderBy('deleted_at')
                        ->orderBy('contractors_bank_account_details.bank')
                        ->with('bankClassifier');
                },
                'contactPersons' => static function ($query) {
                    $query->orderBy('deleted_at')
                        ->orderByDesc('contractors_contact_persons.name');
                },
                'drivers' => static function ($query) {
                    $query->orderBy('deleted_at')
                        ->orderBy('name');
                },
                'cars' => static function ($query) {
                    $query->orderBy('deleted_at')
                        ->orderBy('car_model');
                },
                'trailers' => static function ($query) {
                    $query->orderBy('deleted_at')
                        ->orderBy('type');
                },
                'contracts' => static function ($query) {
                    $query->orderBy('deleted_at')
                        ->where('organization_id', session('organization_id'))
                        ->orderBy('date');
                },
            ]
        );

        return $contractor;
    }

    /**
     * @param array $validated
     *
     * @return Contractor
     */
    public function create(array $validated): Contractor
    {
        return $this->model->create(
            $this->getFilled($validated)
        );
    }

    /**
     * @param array $validated
     *
     * @return array
     */
    protected function getFilled(array $validated): array
    {
        return [
            'user_id' => Auth::user()->id,
            'legal_form_type' => $validated['legal_form_type'],
            'name' => $validated['name'],
            'INN' => $validated['INN'],
            'OKPO' => $validated['OKPO'],
            'kpp' => $validated['kpp'],
            'contacts' => $validated['contacts'],
            'comment' => $validated['comment'],
        ];
    }

    /**
     * @param       $model
     * @param array $validated
     *
     * @return Contractor
     */
    public function update($model, array $validated): Contractor
    {
        $model->fill(
            $this->getFilled($validated)
        )
            ->save();

        return $model;
    }

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Contractor::class;
    }
}
