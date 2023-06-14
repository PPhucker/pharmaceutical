<?php

namespace App\Http\Requests\Documents\Shipment\Protocols;

use App\Http\Requests\Documents\Shipment\CreateShipmentRequest;

class CreateProtocolRequest extends CreateShipmentRequest
{
    protected $afterValidatorFailKeyMessage = 'documents.shipment.protocols.actions.create.fail';
    protected $key = 'protocols';
}
