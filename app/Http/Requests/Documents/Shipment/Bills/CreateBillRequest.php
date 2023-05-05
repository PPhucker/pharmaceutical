<?php

namespace App\Http\Requests\Documents\Shipment\Bills;

use App\Http\Requests\Documents\Shipment\CreateShipmentRequest;

class CreateBillRequest extends CreateShipmentRequest
{
    protected $afterValidatorFailKeyMessage = 'documents.shipment.bills.actions.create.fail';

    protected $key = 'bills';
}
