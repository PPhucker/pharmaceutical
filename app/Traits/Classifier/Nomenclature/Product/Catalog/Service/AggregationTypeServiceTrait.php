<?php

namespace App\Traits\Classifier\Nomenclature\Product\Catalog\Service;

use App\Logging\Logger;
use App\Models\Classifier\Nomenclature\Product\Catalog\ProductCatalog;

/**
 * Трейт сервиса, содержащий методы для работы с типами агрегации готовой продукции из каталога.
 */
trait AggregationTypeServiceTrait
{
    /**
     * @param ProductCatalog $productCatalog
     * @param array          $validated
     *
     * @return void
     */
    public function attachAggregationType(ProductCatalog $productCatalog, array $validated): void
    {
        $this->selectedRepo->attachAggregationType(
            $productCatalog->aggregationTypes(),
            $validated
        );

        (new Logger())->userActionNotice(
            'attach',
            $productCatalog,
            [
                'table' => $productCatalog->aggregationTypes()->getTable(),
                'id' => $validated['aggregation_type'],
            ]
        );
    }

    /**
     * @param ProductCatalog $productCatalog
     * @param array          $validated
     *
     * @return void
     */
    public function detachAggregationType(ProductCatalog $productCatalog, array $validated): void
    {
        $this->selectedRepo->detachAggregationType(
            $productCatalog->aggregationTypes(),
            $validated
        );

        (new Logger())->userActionNotice(
            'detach',
            $productCatalog,
            [
                'table' => $productCatalog->aggregationTypes()->getTable(),
                'id' => $validated['aggregation_type']
            ]
        );
    }

    /**
     * @param ProductCatalog $productCatalog
     * @param array          $validated
     *
     * @return void
     */
    public function updateAggregationTypeProductQuantity(ProductCatalog $productCatalog, array $validated): void
    {
        $this->selectedRepo->updateAggregationTypeProductQuantity(
            $productCatalog->aggregationTypes(),
            $validated
        );

        foreach ($validated as $key => $value) {
            (new Logger())->userActionNotice(
                'attach',
                $productCatalog,
                [
                    'table' => $productCatalog->aggregationTypes()->getTable(),
                    'id' => $value['aggregation_type'],
                    'quantity' => $value['product_quantity'],
                ]
            );
        }
    }
}
