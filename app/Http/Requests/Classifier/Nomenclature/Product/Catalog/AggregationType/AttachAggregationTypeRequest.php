<?php

namespace App\Http\Requests\Classifier\Nomenclature\Product\Catalog\AggregationType;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

/**
 * Валидация добавления типа агрегации к готовому продукту из каталога.
 */
class AttachAggregationTypeRequest extends CoreFormRequest
{
    /**
     * @return array[]
     */
    public function rules(): array
    {
        $prefix = 'product_catalog_types_of_aggregation.';

        $productId = $this->input($prefix . 'product_catalog_id');

        $uniqueRule = Rule::unique('product_catalog_types_of_aggregation')
            ->where(function ($query) use ($productId) {
                return $query->where('product_catalog_id', $productId);
            });

        return [
            $prefix . 'aggregation_type' => [
                'required',
                'string',
                'max:10',
                $uniqueRule,
            ],
            $prefix . 'product_quantity' => [
                'required',
                'numeric',
                'min:1',
            ],
        ];
    }
}
