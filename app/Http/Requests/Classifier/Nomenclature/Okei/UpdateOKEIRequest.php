<?php

namespace App\Http\Requests\Classifier\Nomenclature\Okei;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

/**
 * Валидация обновления классификатора ОКЕИ.
 */
class UpdateOKEIRequest extends CoreFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'okei.*.';

        return [
            $prefix . 'code' => [
                'required',
                'string',
                'max:10',
                Rule::unique('classifier_okei', 'code')
                    ->whereNotIn('code', $this->input($prefix . 'code')),
            ],
            $prefix . 'original_code' => [
                'required',
                'string',
                'max:10',
                Rule::unique('classifier_okei', 'code')
                    ->whereNotIn('code', $this->input($prefix . 'original_code')),
            ],
            $prefix . 'unit' => [
                'required',
                'string',
                'max:20',
            ],
            $prefix . 'symbol' => [
                'required',
                'string',
                'max:10',
            ],
        ];
    }
}
