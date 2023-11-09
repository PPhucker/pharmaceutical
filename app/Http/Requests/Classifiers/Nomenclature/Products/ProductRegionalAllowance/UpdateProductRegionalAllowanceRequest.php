<?php

namespace App\Http\Requests\Classifiers\Nomenclature\Products\ProductRegionalAllowance;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

/**
 * Валидация обновления региональных надбавок готовой продукции.
 */
class UpdateProductRegionalAllowanceRequest extends CoreFormRequest
{
    public const AFTER_VALIDATOR_SUCCESS_KEY_MESSAGE
        = 'classifiers.nomenclature.products.regional_allowances.action.update.success';
    protected $afterValidatorFailKeyMessage
        = 'classifiers.nomenclature.products.regional_allowances.action.update.fail';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'product_regional_allowances.*.';

        return [
            $prefix . 'id' => [
                'required',
                'numeric',
            ],
            $prefix . 'product_catalog_id' => [
                'required',
                'numeric',
            ],
            $prefix . 'region_id' => [
                'required',
                'numeric',
                Rule::unique('product_regional_allowances', 'region_id')
                    ->where('region_id', $this->input($prefix . 'region_id'))
                    ->whereNotIn('region_id', $this->input($prefix . 'region_id')),
            ],
            $prefix . 'allowance' => [
                'required',
                'numeric',
                'max:100',
            ],
        ];
    }
}
