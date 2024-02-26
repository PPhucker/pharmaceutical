<?php

namespace App\Repositories\Documents\InvoicesForPayment;

use App\Models\Documents\InvoicesForPayment\InvoiceForPayment;
use App\Models\Documents\InvoicesForPayment\InvoiceForPaymentMaterial as Model;
use App\Repositories\Classifier\Nomenclature\Material\MaterialRepository;
use App\Repositories\CoreRepository;
use Illuminate\Database\Eloquent\Collection;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class InvoiceForPaymentMaterialRepository extends CoreRepository
{
    /**
     * @param int $invoiceForPaymentId
     *
     * @return Collection
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getInvoiceForPaymentMaterials(int $invoiceForPaymentId)
    {
        return $this->clone()
            ->where(
                'documents_invoices_for_payment_materials.invoice_for_payment_id',
                $invoiceForPaymentId
            )
            ->with(
                [
                    'material' => static function ($query) {
                        $query->select(
                            [
                                'id',
                                'name',
                                'okei_code',
                                'price',
                                'nds',
                            ]
                        )
                            ->with(
                                [
                                    'okei:code,symbol,unit',
                                ]
                            );
                    },
                ]
            )
            ->get();
    }

    /**
     * @param int $invoiceForPaymentId
     *
     * @return Collection
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getMaterials(int $invoiceForPaymentId)
    {
        $invoiceForPayment = InvoiceForPayment::find($invoiceForPaymentId);

        $invoiceProducts = $invoiceForPayment->production;

        $materialRepository = new MaterialRepository();

        if ($invoiceProducts->count()) {
            return $materialRepository
                ->getMaterialCatalog(
                    (float)$invoiceProducts->first()->nds,
                    $invoiceProducts->pluck('material_id')->toArray()
                );
        }

        return $materialRepository->getMaterialCatalog();
    }

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}
