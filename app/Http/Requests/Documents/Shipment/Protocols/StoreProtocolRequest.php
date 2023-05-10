<?php

namespace App\Http\Requests\Documents\Shipment\Protocols;

use App\Http\Requests\Documents\Shipment\StoreShipmentRequest;

class StoreProtocolRequest extends StoreShipmentRequest
{
    protected $afterValidatorFailKeyMessage = 'documents.shipment.protocols.actions.create.fail';
}
