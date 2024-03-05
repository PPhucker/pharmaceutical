<?php

namespace App\Http\Requests\Classifier\Nomenclature\Product\Okpd2;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

/**
 * Валидация обновления классификатора ОКПД2.
 */
class UpdateOKPD2Request extends CoreFormRequest
{
    protected $prefixLocalKey = 'classifiers.nomenclature.products.okpd2';

    protected $action = 'update';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'okpd2.*.';

        return [
            $prefix . 'code' => [
                'required',
                'max:20',
                Rule::unique('classifier_okpd2', 'code')
                    ->whereNotIn('code', $this->input($prefix . 'code'))
            ],
            $prefix . 'original_code' => [
                'required',
                'max:20',
                Rule::unique('classifier_okpd2', 'code')
                    ->whereNotIn('code', $this->input($prefix . 'original_code'))
            ],
            $prefix . 'name' => [
                'required',
                'string',
                'max:150',
            ],
        ];
    }
}
