<?php

namespace App\Http\Requests\Documents\Shipment\Waybills;

use App\Http\Requests\Documents\Shipment\CreateShipmentRequest;

class CreateWaybillRequest extends CreateShipmentRequest
{
    protected $key = 'waybills';
    protected $afterValidatorFailKeyMessage = 'documents.shipment.waybills.actions.create.fail';
}
