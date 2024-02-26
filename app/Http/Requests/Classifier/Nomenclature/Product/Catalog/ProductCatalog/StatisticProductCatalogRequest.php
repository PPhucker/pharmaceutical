<?php

namespace App\Http\Requests\Classifiers\Nomenclature\Products\ProductCatalog;

use App\Http\Requests\CoreFormRequest;

class StatisticProductCatalogRequest extends CoreFormRequest
{
    protected $afterValidatorFailKeyMessage = 'classifiers.nomenclature.products.product_catalog.actions.statistic.fail';

    protected $rules = [
        'fromDate' => [
            'nullable',
            'date',
        ],
        'toDate' => [
            'nullable',
            'date',
        ],
    ];
}
