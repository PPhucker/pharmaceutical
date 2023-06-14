<?php

namespace App\Http\Requests\Documents\Shipment\Appendixes;

use App\Http\Requests\Documents\Shipment\StoreShipmentRequest;

class StoreAppendixRequest extends StoreShipmentRequest
{
    protected $afterValidatorFailKeyMessage = 'documents.shipment.appendixes.actions.create.fail';
}
