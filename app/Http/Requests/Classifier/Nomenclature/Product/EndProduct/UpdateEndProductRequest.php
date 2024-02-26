<?php

namespace App\Http\Requests\Classifier\Nomenclature\Product\EndProduct;

/**
 * Валидация обновления конечного продукта.
 */
class UpdateEndProductRequest extends StoreEndProductRequest
{
    protected $action = 'update';
}
