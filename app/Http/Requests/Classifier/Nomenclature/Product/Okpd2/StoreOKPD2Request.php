<?php

namespace App\Http\Requests\Classifier\Nomenclature\Product\Okpd2;

use App\Http\Requests\CoreFormRequest;

/**
 * Валидация добавления новой записи в классификатор ОКПД2.
 */
class StoreOKPD2Request extends CoreFormRequest
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
        $prefix = 'okpd2.';

        return [
            $prefix . 'code' => [
                'required',
                'max:20',
                'unique:classifier_okpd2,code'
            ],
            $prefix . 'name' => [
                'required',
                'string',
                'max:150',
            ],
        ];
    }
}
