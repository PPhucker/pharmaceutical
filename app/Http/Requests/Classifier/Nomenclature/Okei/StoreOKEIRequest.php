<?php

namespace App\Http\Requests\Classifier\Nomenclature\Okei;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация добавления записи в классификатор ОКЕИ.
 */
class StoreOKEIRequest extends CoreFormRequest
{
    protected $prefixLocalKey = 'classifiers.nomenclature.okei';

    protected $action = 'create';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $prefix = 'okei.';

        return [
            $prefix . 'code' => [
                'required',
                'string',
                'max:10',
                'unique:classifier_okei,code',
            ],
            $prefix . 'unit' => [
                'required',
                'string',
                'max:20',
                'unique:classifier_okei,unit',
            ],
            $prefix . 'symbol' => [
                'required',
                'string',
                'max:10',
                'unique:classifier_okei,symbol',
            ],
        ];
    }
}
