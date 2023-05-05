<?php

namespace App\Http\Requests\Documents\Shipment\Appendixes;

use App\Http\Requests\Documents\Shipment\CreateShipmentRequest;

class CreateAppendixRequest extends CreateShipmentRequest
{
    protected $afterValidatorFailKeyMessage = 'documents.shipment.appendixes.actions.create.fail';

    protected $key = 'appendixes';
}
