<?php

namespace App\Http\Requests\Documents\Shipment\Protocols;

use App\Http\Requests\Documents\Shipment\UpdateShipmentRequest;

class UpdateProtocolRequest extends UpdateShipmentRequest
{
    protected $afterValidatorFailKeyMessage = 'documents.shipment.protocols.actions.create.fail';
}
