<?php

namespace App\Http\Requests\Documents\Shipment\PackingLists;

use App\Models\Documents\Shipment\PackingLists\PackingList;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

/**
 * Валидация обновления товарной накладной.
 */
class UpdatePackingListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'packing_list_id' => [
                'required',
                'numeric',
            ],
            'organization_place_id' => [
                'required',
                'numeric',
            ],
            'organization_bank_id' => [
                'required',
                'numeric',
            ],
            'contractor_place_id' => [
                'required',
                'numeric',
            ],
            'contractor_bank_id' => [
                'required',
                'numeric',
            ],
            'number' => [
                'required',
                'string',
                'max:10',
            ],
            'date' => [
                'required',
                'date',
            ],
            'director' => [
                'nullable',
                'string',
                'max:60',
            ],
            'bookkeeper' => [
                'nullable',
                'string',
                'max:60',
            ],
            'storekeeper' => [
                'nullable',
                'string',
                'max:60',
            ],
        ];
    }

    /**
     * @param Validator $validator
     *
     * @return void
     */
    protected function withValidator(Validator $validator): void
    {
        $packingListId = (int)$this->input('packing_list_id');

        $validator->after(function ($validator) use ($packingListId) {
            if (PackingList::find($packingListId)->approved) {
                $validator->errors()->add(
                    'fail',
                    __('documents.shipment.errors.approve_update')
                );
            }
            if ($validator->errors()->isNotEmpty()) {
                $validator->errors()->add(
                    'fail',
                    __('documents.shipment.packing_lists.actions.update.fail')
                );
            }
        });
    }
}
