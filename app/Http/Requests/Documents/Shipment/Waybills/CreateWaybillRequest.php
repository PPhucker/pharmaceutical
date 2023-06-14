<?php

namespace App\Http\Requests\Documents\Shipment\Waybills;

use App\Http\Requests\Documents\Shipment\CreateShipmentRequest;
use App\Models\Documents\Shipment\PackingLists\PackingList;
use Illuminate\Validation\Rule;

class CreateWaybillRequest extends CreateShipmentRequest
{
    protected $key = 'waybills';
    protected $afterValidatorFailKeyMessage = 'documents.shipment.waybills.actions.create.fail';

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'packing_list_id' => [
                'required',
                'numeric',
                Rule::unique(
                    'documents_shipment_' . $this->key,
                    'packing_list_id'
                )
                    ->whereNull('deleted_at'),
                static function ($attribute, $value, $fail) {
                    $packingList = PackingList::find((int)$value);
                    if (!$packingList->bill) {
                        $fail(__('documents.shipment.waybills.errors.packing_list_id.last'));
                    }
                },
            ],
        ];
    }
}
