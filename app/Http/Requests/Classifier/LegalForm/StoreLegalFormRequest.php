<?php

namespace App\Http\Requests\Classifier\LegalForm;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация добавления органнизационно провавой формы.
 */
class StoreLegalFormRequest extends CoreFormRequest
{
    protected $prefixLocalKey = 'classifiers.legal_forms';

    protected $action = 'create';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'legal_form.';

        return [
            $prefix . 'abbreviation' => [
                'required',
                'string',
                'max: 15',
                'unique:classifier_legal_forms,abbreviation',
            ],

            $prefix . 'decoding' => [
                'nullable',
                'string',
                'max: 150'
            ],
        ];
    }
}
