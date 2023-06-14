<?php

namespace App\Http\Requests\Documents\Shipment;

use App\Http\Requests\CoreFormRequest;

abstract class StoreShipmentRequest extends CoreFormRequest
{
    /**
     * @var array[]
     */
    protected $rules = [
        'packing_list_id' => [
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
    ];
}
