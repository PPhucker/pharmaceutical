<?php

namespace App\Repositories\Documents\Shipment;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

abstract class ShipmentRepository
{
    /**
     * @var Model
     */
    protected $model;

    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return mixed
     */
    abstract protected function getModelClass();

    /**
     * @param array $filters
     * @param bool  $withTrashed
     *
     * @return Collection
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getAll(array $filters, bool $withTrashed = true)
    {
        $model = $this->clone();

        $table = $model->getTable();

        if (!$withTrashed) {
            $model = $model->withoutTrashed();
        } else {
            $model = $model->withTrashed();
        }

        /**
         * Фильтр по поставщику товарной накладной.
         */
        if ($organizationId = $filters['organization_id']) {
            $join = $model->clone()->join(
                'documents_shipment_packing_lists',
                function (JoinClause $join) use (
                    $table,
                    $organizationId
                ) {
                    $join->on(
                        $table . '.packing_list_id',
                        '=',
                        'documents_shipment_packing_lists.id'
                    )
                        ->where(
                            'documents_shipment_packing_lists.organization_id',
                            '=',
                            (int)$organizationId
                        );
                }
            );

            if (count($join->get()) === 0) {
                return collect();
            }
        }

        $model->whereBetween(
            $table . '.date',
            [$filters['from_date'], $filters['to_date']]
        );

        return $model->with(
            [
                'packingList' => function ($query) {
                    $query->select(
                        [
                            'id',
                            'number',
                            'organization_id',
                            'organization_place_id',
                            'contractor_id',
                            'contractor_place_id',
                            'deleted_at',
                        ]
                    )
                        ->with(
                            [
                                'organization:id,name,legal_form_type',
                                'organizationPlaceOfBusiness:id,address',
                                'contractor:id,name,legal_form_type',
                                'contractorPlaceOfBusiness:id,address',
                            ]
                        );
                }
            ]
        )
            ->orderBy($table . '.date', 'desc')
            ->get();
    }

    /**
     * @return Application|Model|mixed
     */
    protected function clone()
    {
        return clone $this->model;
    }

    /**
     * @param int $id
     *
     * @return Collection|null
     */
    public function getById(int $id)
    {
        $model = $this->model::find($id);

        $model->load(
            [
                'updatedBy' => function ($query) {
                    $query->select(
                        'id',
                        'name',
                    );
                },
            ]
        );

        return $model;
    }

    /**
     * @param int $id
     *
     * @return Collection
     */
    public function getStorage(int $id)
    {
        $shipmentDocument = $this->model::find($id);

        $documentDate = Carbon::create($shipmentDocument->date);

        return collect(
            [
                'directory' => $this->model::STORAGE
                    . $documentDate->format('Y')
                    . '/'
                    . $documentDate->format('m')
                    . '/',
                'filename' => '№'
                    . $shipmentDocument->number
                    . '_'
                    . Carbon::now()->format('d_m_Y_H_i_s')
                    . '.pdf',
            ]
        );
    }
}
