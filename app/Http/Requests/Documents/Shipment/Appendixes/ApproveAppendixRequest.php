<?php

namespace App\Http\Requests\Documents\Shipment\Appendixes;

use App\Http\Requests\Documents\Shipment\ApproveShipmentRequest;

class ApproveAppendixRequest extends ApproveShipmentRequest
{
    protected $afterValidatorFailKeyMessage = 'documents.shipment.appendixes.actions.update.fail';
}
