<?php

namespace App\Http\Requests\Documents\Shipment\Appendixes;

use App\Http\Requests\Documents\Shipment\UpdateShipmentRequest;

class UpdateAppendixRequest extends UpdateShipmentRequest
{
    protected $afterValidatorFailKeyMessage = 'documents.shipment.appendixes.actions.update.fail';
}
