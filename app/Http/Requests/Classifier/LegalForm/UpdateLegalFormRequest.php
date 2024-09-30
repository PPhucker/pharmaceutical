<?php

namespace App\Http\Requests\Classifier\LegalForm;

use App\Http\Requests\CoreFormRequest;
use Illuminate\Validation\Rule;

/**
 * Валидация обновления организационно правовых форм.
 */
class UpdateLegalFormRequest extends CoreFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'legal_forms';

        return [
            $prefix . '.*.original_abbreviation' => [
                'required',
                'string',
            ],
            $prefix . '.*.abbreviation' => [
                'required',
                'string',
                'max: 15',
                'distinct',
                Rule::unique('classifier_legal_forms', 'abbreviation')
                    ->whereNotIn('abbreviation', $this->input($prefix . '.*.abbreviation'))
            ],
            $prefix . '.*.decoding' => [
                'nullable',
                'string',
                'max: 150'
            ]
        ];
    }
}
