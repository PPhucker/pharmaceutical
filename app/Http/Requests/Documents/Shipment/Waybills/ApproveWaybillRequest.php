<?php

namespace App\Http\Requests\Documents\Shipment\Waybills;

use App\Http\Requests\Documents\Shipment\ApproveShipmentRequest;

class ApproveWaybillRequest extends ApproveShipmentRequest
{
    protected $afterValidatorFailKeyMessage = 'documents.shipment.waybills.actions.update.fail';
}
