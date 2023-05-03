<?php

namespace App\Http\Requests\Documents\Shipment;

use App\Http\Requests\CoreFormRequest;

abstract class CreateShipmentRequest extends CoreFormRequest
{
    /**
     * @var array[]
     */
    protected $rules = [
        'packing_list_id' => [
            'required',
            'numeric',
        ],
    ];
}
