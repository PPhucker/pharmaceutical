<?php

namespace App\Http\Requests\Documents\Shipment\Bills;

use App\Http\Requests\Documents\Shipment\UpdateShipmentRequest;

class UpdateBillRequest extends UpdateShipmentRequest
{
    protected $afterValidatorFailKeyMessage = 'documents.shipment.bills.actions.update.fail';
}
