<?php

namespace App\Repositories\Documents\InvoicesForPayment;

use App\Models\Documents\InvoicesForPayment\InvoiceForPaymentProduct as Model;
use App\Repositories\CoreRepository;

class InvoiceForPaymentProductRepository extends CoreRepository
{
    public function getInvoiceForPaymentProduction(int $invoiceForPaymentId)
    {
        return $this->clone()
            ->where(
                'documents_invoices_for_payment_production.invoice_for_payment_id',
                $invoiceForPaymentId
            )
            ->with(
                [
                    'productCatalog' => static function ($query) {
                        $query->select(['id', 'product_id'])
                            ->with(
                                [
                                    'endProduct' => static function ($query) {
                                        $query->select(
                                            [
                                                'id',
                                                'registration_number_id',
                                                'okei_code',
                                                'okpd2_code',
                                                'full_name',
                                            ]
                                        )
                                            ->with(
                                                [
                                                    'registrationNumber:id,number',
                                                    'okei:code,symbol',
                                                    'okpd2:code',
                                                ]
                                            );
                                    },
                                ]
                            );
                    },
                ]
            )
            ->orderBy('documents_invoices_for_payment_production.id')
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
