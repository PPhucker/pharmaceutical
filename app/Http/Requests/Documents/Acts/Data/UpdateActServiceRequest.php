<?php

namespace App\Http\Requests\Documents\Acts\Data;

use App\Http\Requests\CoreFormRequest;

class UpdateActServiceRequest extends CoreFormRequest
{
    protected $afterValidatorFailKeyMessage = 'documents.acts.data.actions.update.fail';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $prefix = 'act_services.*.';

        return [
            $prefix . 'id' => [
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
