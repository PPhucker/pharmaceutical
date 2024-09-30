<?php

namespace App\Http\Requests\Classifier\Nomenclature\Product\Catalog;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация получения статистики продаж наименования каталога готовой продукции.
 */
class SalesStatisticsByContracorRequest extends CoreFormRequest
{
    protected $rules = [
        'start_date' => [
            'nullable',
            'date',
        ],
        'end_date' => [
            'nullable',
            'date',
        ],
    ];
}
