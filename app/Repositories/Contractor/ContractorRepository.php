<?php

namespace App\Repositories\Contractor;

use App\Models\Contractor\Contractor;
use App\Repositories\ResourceRepository;
use DB;
use Illuminate\Database\Eloquent\Collection;
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
            ->select(
                [
                    'id',
                    'legal_form_type',
                    'name',
                    'INN',
                    'OKPO',
                    'contacts',
                    'comment',
                    'deleted_at'
                ]
            )
            ->orderBy('id');

        if ($withTrashed) {
            $contractors->withTrashed();
        }

        return $contractors->with('legalForm:abbreviation')
            ->with('contracts')
            ->get()
            ->sortBy('full_name');
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
     * Стастистика продаж продукта по контрагентам.
     *
     * @param int   $productCatalogId
     * @param array $filters
     *
     * @return Collection
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function productCatalogSaleStatistic(int $productCatalogId, array $filters): Collection
    {
        return $this->clone()
            ->whereHas('packingLists', function ($query) use ($productCatalogId, $filters) {
                $query->whereBetween('date', [$filters['from_date'], $filters['to_date']])
                    ->where('approved', '=', 1)
                    ->whereHas('production', function ($query) use ($productCatalogId) {
                        $query->where('product_id', '=', $productCatalogId);
                    });
            })
            ->with(
                [
                    'packingLists' => function ($query) use ($productCatalogId) {
                        $query->with(
                            [
                                'production' => function ($query) use ($productCatalogId) {
                                    $query->where('product_id', '=', $productCatalogId);
                                },
                            ]
                        );
                    }
                ]
            )
            ->get();
    }

    /**
     * Получить список покупателей на период.
     *
     * @param array $between
     * @param int   $take
     *
     * @return mixed
     */
    public function getCustomersForPeriodBySales(array $between, int $take = 10)
    {
        return $this->model::select([
            'contractors.id',
            'contractors.name',
            'contractors.legal_form_type',
            DB::raw(
                'SUM(
                documents_shipment_packing_lists_production.price
                    * documents_shipment_packing_lists_production.quantity
                )
                as sum'
            )
        ])
            ->withoutTrashed()
            ->join('documents_shipment_packing_lists', function ($join) use ($between) {
                $join->on(
                    'documents_shipment_packing_lists.contractor_id',
                    '=',
                    'contractors.id'
                )
                    ->whereBetween(
                        'documents_shipment_packing_lists.date',
                        $between
                    );
            })
            ->join('documents_shipment_packing_lists_production', function ($join) {
                $join->on(
                    'documents_shipment_packing_lists_production.packing_list_id',
                    '=',
                    'documents_shipment_packing_lists.id'
                );
            })
            ->groupBy('contractors.id')
            ->orderBy('sum', 'desc')
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
                    $query->orderByDesc('contractors_places_of_business.registered')
                        ->orderByDesc('contractors_places_of_business.address')
                        ->with('region');
                },
                'bankAccountDetails' => static function ($query) {
                    $query->orderBy('contractors_bank_account_details.bank')
                        ->with('bankClassifier');
                },
                'contactPersons' => static function ($query) {
                    $query->orderByDesc('contractors_contact_persons.name');
                },
                'drivers' => static function ($query) {
                    $query->orderBy('name');
                },
                'cars' => static function ($query) {
                    $query->orderBy('car_model');
                },
                'trailers' => static function ($query) {
                    $query->orderBy('type');
                },
                'contracts' => static function ($query) {
                    $query->orderBy('date');
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
            [
                'user_id' => Auth::user()->id,
                'legal_form_type' => $validated['legal_form_type'],
                'name' => $validated['name'],
                'INN' => $validated['INN'],
                'OKPO' => $validated['OKPO'],
                'kpp' => $validated['kpp'],
                'contacts' => $validated['contacts'],
                'comment' => $validated['comment'],
            ]
        );
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
            [
                'user_id' => Auth::user()->id,
                'legal_form_type' => $validated['legal_form_type'],
                'name' => $validated['name'],
                'INN' => $validated['INN'],
                'OKPO' => $validated['OKPO'],
                'kpp' => $validated['kpp'],
                'contacts' => $validated['contacts'],
                'comment' => $validated['comment'],
            ]
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
