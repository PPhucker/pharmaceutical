<?php

namespace App\Http\Requests\Documents\Shipment;

use App\Http\Requests\CoreFormRequest;

abstract class IndexShipmentRequest extends CoreFormRequest
{
    public $rules = [
        'fromDate' => [
            'nullable',
            'date',
        ],
        'toDate' => [
            'nullable',
            'date',
        ],
        'organization_id' => [
            'nullable',
            'numeric',
        ],
    ];
}
