<?php

namespace App\Http\Requests\Documents\Acts\Data;

use App\Http\Requests\CoreFormRequest;

class StoreActServiceRequest extends CoreFormRequest
{
    protected $afterValidatorFailKeyMessage = 'documents.acts.data.actions.create.fail';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $prefix = 'act_service.';

        return [
            $prefix . 'act_id' => [
                'required',
                'numeric',
            ],
            $prefix . 'service_id' => [
                'required',
                'numeric',
            ],
            $prefix . 'quantity' => [
                'required',
                'numeric',
                'min:1'
            ],
            $prefix . 'price' => [
                'required',
                'numeric',
                'min:0',
            ],
            $prefix . 'nds' => [
                'required',
                'numeric',
                'min:1',
                'max:100',
            ],
        ];
    }
}
