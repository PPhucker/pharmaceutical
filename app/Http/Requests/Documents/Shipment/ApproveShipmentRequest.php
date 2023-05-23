<?php

namespace App\Http\Requests\Documents\Shipment;

use App\Http\Requests\CoreFormRequest;

class ApproveShipmentRequest extends CoreFormRequest
{
    /**
     * @var array[]
     */
    protected $rules = [
        'filename' => [
            'nullable',
            'file',
            'mimes:pdf',
            'max:15000',
        ],
        'approved' => [
            'nullable',
            'boolean',
        ],
        'comment' => [
            'nullable',
            'string',
        ],
    ];
}
