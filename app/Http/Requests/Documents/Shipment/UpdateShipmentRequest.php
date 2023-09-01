<?php

namespace App\Http\Requests\Documents\Shipment;

use App\Http\Requests\CoreFormRequest;

abstract class UpdateShipmentRequest extends CoreFormRequest
{
    /**
     * @var array[]
     */
    protected $rules = [
        'document_id' => [
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
        'filename' => [
            'nullable',
            'file',
            'mimes:pdf',
            'max:15000',
        ],
    ];
}
