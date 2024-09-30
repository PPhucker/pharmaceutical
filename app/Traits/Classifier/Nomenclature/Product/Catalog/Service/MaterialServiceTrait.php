<?php

namespace App\Traits\Classifier\Nomenclature\Product\Catalog\Service;

use App\Logging\Logger;
use App\Models\Classifier\Nomenclature\Product\Catalog\ProductCatalog;

/**
 * Трейт для сервиса комплектющих готовой продукции.
 */
trait MaterialServiceTrait
{
    /**
     * Прикрепление комплектующего к наименованию из каталога готовой продукции.
     *
     * @param ProductCatalog $productCatalog
     * @param array          $validated
     *
     * @return void
     */
    public function attachMaterial(ProductCatalog $productCatalog, array $validated): void
    {
        $this->selectedRepo->attachMaterial(
            $productCatalog->materials(),
            $validated
        );

        (new Logger())->userActionNotice(
            'attach',
            $productCatalog,
            [
                'id' => $validated['id'],
                'table' => $productCatalog->materials()->getTable(),
            ]
        );
    }

    /**
     * Отвязать комплектующее от наименования из каталога готовой продукции.
     *
     * @param ProductCatalog $productCatalog
     * @param array          $validated
     *
     * @return void
     */
    public function detachMaterial(ProductCatalog $productCatalog, array $validated): void
    {
        $this->selectedRepo->detachMaterial(
            $productCatalog->materials(),
            $validated
        );

        (new Logger())->userActionNotice(
            'detach',
            $productCatalog,
            [
                'id' => $validated['id'],
                'table' => $productCatalog->materials()->getTable(),
            ]
        );
    }
}
