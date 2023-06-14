<?php

namespace App\Http\Requests\Documents\Shipment\Protocols;

use App\Http\Requests\Documents\Shipment\ApproveShipmentRequest;

class ApproveProtocolRequest extends ApproveShipmentRequest
{
    protected $afterValidatorFailKeyMessage = 'documents.shipment.protocols.actions.update.fail';
}
