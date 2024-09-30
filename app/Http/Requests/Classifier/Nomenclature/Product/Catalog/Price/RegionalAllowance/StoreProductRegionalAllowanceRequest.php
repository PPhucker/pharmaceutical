<?php

namespace App\Http\Requests\Classifiers\Nomenclature\Products\ProductRegionalAllowance;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

/**
 * Валидация добавления региональной надбавки.
 */
class StoreProductRegionalAllowanceRequest extends CoreFormRequest
{
    public const AFTER_VALIDATOR_SUCCESS_KEY_MESSAGE
        = 'classifiers.nomenclature.products.regional_allowances.actions.create.success';
    protected $afterValidatorFailKeyMessage
        = 'classifiers.nomenclature.products.regional_allowances.actions.create.fail';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'product_regional_allowance.';

        return [
            $prefix . 'product_catalog_id' => [
                'required',
                'numeric',
            ],
            $prefix . 'region_id' => [
                'required',
                'numeric',
                Rule::unique('product_regional_allowances', 'region_id')
                    ->where('region_id', $this->input($prefix . 'region_id'))
                    ->where('product_catalog_id', $this->input($prefix . 'product_catalog_id'))
            ],
            $prefix . 'allowance' => [
                'required',
                'numeric',
                'max:100',
            ],
        ];
    }
}
