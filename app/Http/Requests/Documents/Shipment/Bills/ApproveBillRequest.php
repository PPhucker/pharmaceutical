<?php

namespace App\Http\Requests\Documents\Shipment\Bills;

use App\Http\Requests\Documents\Shipment\ApproveShipmentRequest;

class ApproveBillRequest extends ApproveShipmentRequest
{
    protected $afterValidatorFailKeyMessage = 'documents.shipment.bills.actions.update.fail';
}
