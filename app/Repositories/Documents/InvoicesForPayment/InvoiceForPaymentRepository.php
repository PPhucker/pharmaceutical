<?php

namespace App\Repositories\Documents\InvoicesForPayment;

use App\Models\Documents\InvoicesForPayment\InvoiceForPayment as Model;
use App\Repositories\CoreRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class InvoiceForPaymentRepository extends CoreRepository
{
    /**
     * @param array $filters
     *
     * @return Collection
     */
    public function getAll(array $filters)
    {
        $invoices = $this->clone()->select(
            [
                'documents_invoices_for_payment.id',
                'documents_invoices_for_payment.user_id',
                'documents_invoices_for_payment.organization_id',
                'documents_invoices_for_payment.organization_place_id',
                'documents_invoices_for_payment.contractor_id',
                'documents_invoices_for_payment.contractor_place_id',
                'documents_invoices_for_payment.number',
                'documents_invoices_for_payment.date',
                'documents_invoices_for_payment.deleted_at',
            ]
        );

        if (isset($filters['organization_id'])) {
            $invoices->where(
                'documents_invoices_for_payment.organization_id',
                (int)$filters['organization_id']
            );
        }

        return $invoices
            ->whereBetween(
                'documents_invoices_for_payment.date',
                [$filters['fromDate'], $filters['toDate']]
            )
            ->withTrashed()
            ->with(
                [
                    'organization:id,name,legal_form_type',
                    'organizationPlaceOfBusiness:id,address',
                    'contractor:id,name,legal_form_type',
                    'contractorPlaceOfBusiness:id,address',
                ]
            )
            ->orderBy('date', 'desc')
            ->get();
    }

    /**
     * @param int $id
     *
     * @return Collection
     */
    public function getForEdit(int $id)
    {
        $invoice = $this->model::find($id);

        $invoice->load(
            [
                'user' => static function ($query) {
                    $query->select(
                        [
                            'id',
                            'name'
                        ]
                    );
                },
                'contractor' => static function ($query) {
                    $query->select(
                        [
                            'id',
                            'name',
                            'legal_form_type'
                        ]
                    )
                        ->with('legalForm:abbreviation');
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
                'organization' => static function ($query) {
                    $query->select(
                        [
                            'id',
                            'name',
                            'legal_form_type'
                        ]
                    )
                        ->with(
                            [
                                'legalForm:abbreviation',
                            ]
                        );
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
                            'product_catalog_id',
                            'invoice_for_payment_id',
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
                                                            'okei_code',
                                                        ]
                                                    )
                                                        ->with('okei:code,symbol');
                                                },
                                                'organization:id,name',
                                                'placeOfBusiness:id,address'
                                            ]
                                        );
                                }
                            ]
                        )
                        ->orderBy('product_catalog_id');
                }
            ]
        );

        return $invoice;
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
                'directory' => Model::FILES_DIRECTORY
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
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}