<?php

namespace App\Repositories\Contractors;

use App\Repositories\CoreRepository;
use App\Models\Contractors\Contractor as Model;
use Illuminate\Database\Eloquent\Collection;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ContractorRepository extends CoreRepository
{
    /**
     * @param bool $withTrashed
     *
     * @return Collection
     */
    public function getAll(bool $withTrashed = true)
    {
        $contractors = $this->clone()
            ->select(
                [
                    'contractors.id',
                    'contractors.legal_form_type',
                    'contractors.name',
                    'contractors.INN',
                    'contractors.OKPO',
                    'contractors.contacts',
                    'contractors.deleted_at'
                ]
            )
            ->orderBy('contractors.id');

        if ($withTrashed) {
            $contractors->withTrashed();
        } else {
            $contractors->withoutTrashed();
        }

        return $contractors->with('legalForm:abbreviation')
            ->get();
    }

    /**
     * @param int $id
     *
     * @return Collection
     */
    public function getById(int $id)
    {
        $contractor = $this->model::find($id);

        $contractor->load(
            [
                'legalForm' => static function ($query) {
                    $query->select('classifier_legal_forms.abbreviation')
                        ->orderBy('abbreviation');
                },
                'placesOfBusiness' => static function ($query) {
                    $query->orderByDesc('contractors_places_of_business.registered');
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
            ]
        );

        return $contractor;
    }

    /**
     * @return \Illuminate\Support\Collection|null
     */
    public function getRegisteredAddress(int $id)
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
     * @param int   $productCatalogId
     * @param array $filters
     *
     * @return Collection
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function productCatalogSaleStatistic(int $productCatalogId, array $filters)
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
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}
