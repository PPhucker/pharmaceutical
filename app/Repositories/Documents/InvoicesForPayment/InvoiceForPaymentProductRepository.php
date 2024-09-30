<?php

namespace App\Repositories\Documents\InvoicesForPayment;

use App\Models\Documents\InvoicesForPayment\InvoiceForPayment;
use App\Models\Documents\InvoicesForPayment\InvoiceForPaymentProduct as Model;
use App\Repositories\Classifier\Nomenclature\Product\Catalog\ProductCatalogRepository;
use App\Repositories\CoreRepository;
use Illuminate\Database\Eloquent\Collection;

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
                    'invoiceForPayment' => static function ($query) {
                        $query->select(
                            [
                                'id',
                                'number',
                                'date'
                            ]
                        )
                            ->get();
                    },
                ]
            )
            ->orderBy('documents_invoices_for_payment_production.id')
            ->get();
    }


    /**
     * @return Collection
     */
    public function getProduction(int $invoiceForPaymentId)
    {
        $invoiceForPayment = InvoiceForPayment::find($invoiceForPaymentId);

        $invoiceProducts = $invoiceForPayment->production;

        $productCatalogRepository = new ProductCatalogRepository();

        if ($invoiceProducts->count()) {
            return $productCatalogRepository
                ->getProductCatalog(
                    (float)$invoiceProducts->first()->nds,
                    $invoiceProducts->pluck('product_catalog_id')->toArray()
                );
        }

        return $productCatalogRepository->getProductCatalog();
    }

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}
