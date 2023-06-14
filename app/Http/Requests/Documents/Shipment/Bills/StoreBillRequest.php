<?php

namespace App\Http\Requests\Documents\Shipment\Bills;

use App\Http\Requests\Documents\Shipment\StoreShipmentRequest;

class StoreBillRequest extends StoreShipmentRequest
{
    protected $afterValidatorFailKeyMessage = 'documents.shipment.bills.actions.create.fail';
}
