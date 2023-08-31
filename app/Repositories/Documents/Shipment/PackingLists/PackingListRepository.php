<?php

namespace App\Repositories\Documents\Shipment\PackingLists;

use App\Models\Documents\Shipment\PackingLists\PackingList;
use App\Models\Documents\Shipment\PackingLists\PackingList as Model;
use App\Repositories\CoreRepository;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class PackingListRepository extends CoreRepository
{
    /**
     * @param array $filters
     * @param bool  $withTrashed
     *
     * @return Collection
     */
    public function getAll(array $filters, bool $withTrashed = true)
    {
        $packingLists = $this->clone()
            ->select(
                [
                    'documents_shipment_packing_lists.id',
                    'documents_shipment_packing_lists.organization_id',
                    'documents_shipment_packing_lists.organization_place_id',
                    'documents_shipment_packing_lists.contractor_id',
                    'documents_shipment_packing_lists.contractor_place_id',
                    'documents_shipment_packing_lists.number',
                    'documents_shipment_packing_lists.date',
                    'documents_shipment_packing_lists.deleted_at',
                ]
            );

        if (!$withTrashed) {
            $packingLists->withoutTrashed();
        } else {
            $packingLists->withTrashed();
        }

        if (isset($filters['organization_id'])) {
            $packingLists->where(
                'documents_shipment_packing_lists.organization_id',
                (int)$filters['organization_id']
            );
        }

        return $packingLists->whereBetween(
            'documents_shipment_packing_lists.date',
            [$filters['from_date'], $filters['to_date']]
        )
            ->with(
                [
                    'organization:id,name,legal_form_type',
                    'organizationPlaceOfBusiness:id,address',
                    'contractor:id,name,legal_form_type',
                    'contractorPlaceOfBusiness:id,address',
                    'production:id',
                ]
            )
            ->orderBy('documents_shipment_packing_lists.date', 'desc')
            ->orderBy('documents_shipment_packing_lists.number', 'desc')
            ->get();
    }

    /**
     * @param array $filters
     *
     * @return Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getApproval(array $filters = [])
    {
        $packingLists = $this->clone()
            ->select(
                [
                    'documents_shipment_packing_lists.id',
                    'documents_shipment_packing_lists.organization_id',
                    'documents_shipment_packing_lists.contractor_id',
                    'documents_shipment_packing_lists.number',
                    'documents_shipment_packing_lists.date',
                    'documents_shipment_packing_lists.approved',
                    'documents_shipment_packing_lists.approved_at',
                    'documents_shipment_packing_lists.approved_by_id',
                    'documents_shipment_packing_lists.updated_at',
                    'documents_shipment_packing_lists.updated_by_id',
                ]
            );

        if (isset($filters['organization_id'])) {
            $packingLists->where(
                'documents_shipment_packing_lists.organization_id',
                (int)$filters['organization_id']
            );
        }

        return $packingLists->whereBetween(
            'documents_shipment_packing_lists.date',
            [$filters['from_date'], $filters['to_date']]
        )
            ->with(
                [
                    'organization:id,name,legal_form_type',
                    'contractor:id,name,legal_form_type',
                    'bill:id,packing_list_id,number,date,updated_at,updated_by_id,approved,approved_at,approved_by_id,comment',
                    'appendix:id,packing_list_id,number,date,updated_at,updated_by_id,approved,approved_at,approved_by_id,comment',
                    'protocol:id,packing_list_id,number,date,updated_at,updated_by_id,approved,approved_at,approved_by_id,comment',
                    'waybill:id,packing_list_id,number,date,updated_at,updated_by_id,approved,approved_at,approved_by_id,comment',
                    'approvedBy:id,name',
                    'updatedBy:id,name',
                ]
            )
            ->orderBy('documents_shipment_packing_lists.date', 'desc')
            ->whereRelation('bill', 'deleted_at', null)
            ->whereRelation('waybill', 'deleted_at', null)
            ->get();
    }

    /**
     * @param int $id
     *
     * @return Collection
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getById(int $id)
    {
        $packingList = $this->model::find($id);
        $packingList->load(
            [
                'createdBy' => static function ($query) {
                    $query->select(
                        [
                            'id',
                            'name'
                        ]
                    );
                },
                'updatedBy' => static function ($query) {
                    $query->select(
                        [
                            'id',
                            'name'
                        ]
                    );
                },
                'approvedBy' => static function ($query) {
                    $query->select(
                        [
                            'id',
                            'name'
                        ]
                    );
                },
                'organization' => static function ($query) {
                    $query->select(
                        [
                            'id',
                            'name',
                            'legal_form_type',
                        ]
                    )
                        ->with(
                            [
                                'cars:id,organization_id,car_model,state_number',
                                'drivers:id,organization_id,name',
                                'trailers:id,organization_id,type,state_number',
                                'legalForm:abbreviation',
                            ]
                        );
                },
                'contractor' => static function ($query) {
                    $query->select(
                        [
                            'id',
                            'name',
                            'legal_form_type',
                        ]
                    )
                        ->with(
                            [
                                'cars:id,contractor_id,car_model,state_number',
                                'drivers:id,contractor_id,name',
                                'trailers:id,contractor_id,type,state_number',
                                'legalForm:abbreviation',
                            ]
                        );
                },
                'contractorPlaceOfBusiness' => static function ($query) {
                    $query->select(
                        [
                            'id',
                            'address',
                        ]
                    );
                },
                'contractorBankAccountDetail' => static function ($query) {
                    $query->select(
                        'id',
                        'bank',
                        'payment_account',
                    )
                        ->with('bankClassifier:BIC,name');
                },
                'organizationPlaceOfBusiness' => static function ($query) {
                    $query->select(
                        [
                            'id',
                            'address',
                        ]
                    );
                },
                'organizationBankAccountDetail' => static function ($query) {
                    $query->select(
                        'id',
                        'bank',
                        'payment_account',
                    )
                        ->with('bankClassifier:BIC,name');
                },
                'production' => static function ($query) {
                    $query->select(
                        [
                            'id',
                            'invoice_for_payment_id',
                            'packing_list_id',
                            'product_id',
                            'series',
                            'quantity',
                            'price',
                            'nds',
                            'deleted_at',
                        ]
                    )
                        ->with(
                            [
                                'productCatalog' => static function ($query) {
                                    $query->select(
                                        [
                                            'id',
                                            'product_id',
                                            'organization_id',
                                            'place_of_business_id'
                                        ]
                                    )
                                        ->with(
                                            [
                                                'endProduct' => static function ($query) {
                                                    $query->select(
                                                        [
                                                            'id',
                                                            'short_name',
                                                            'full_name',
                                                            'okei_code',
                                                            'type_id',
                                                        ]
                                                    )
                                                        ->with(
                                                            [
                                                                'okei:code,symbol',
                                                                'type:id,color'
                                                            ]
                                                        );
                                                },
                                                'organization:id,name',
                                                'placeOfBusiness:id,address'
                                            ]
                                        );
                                }
                            ]
                        );
                },
            ]
        )
            ->get();

        return $packingList;
    }

    /**
     * @return Collection
     */
    public function getStorage(int $id)
    {
        $invoice = $this->model::find($id);

        $fileDate = Carbon::create($invoice->date);

        return collect(
            [
                'directory' => $this->model::STORAGE
                    . $fileDate->format('Y')
                    . '/'
                    . $fileDate->format('m')
                    . '/',
                'filename' => '№'
                    . $invoice->number
                    . '_'
                    . Carbon::now()->format('d_m_Y_H_i_s')
                    . '.pdf',
            ]
        );
    }

    /**
     * @param int   $organizationId
     * @param array $between
     *
     * @return int
     */
    public function getCountByPeriod(int $organizationId, array $between)
    {
        return PackingList::select(
            DB::raw('COUNT(id)')
        )
            ->withoutTrashed()
            ->where('organization_id', '=', $organizationId)
            ->whereBetween(
                'date',
                $between
            )
            ->count();
    }

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}
