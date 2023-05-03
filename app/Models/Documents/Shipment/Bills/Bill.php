<?php

namespace App\Models\Documents\Shipment\Bills;

use App\Models\Documents\Shipment\Shipment;
use App\Traits\Documents\Shipment\HasPackingList;

class Bill extends Shipment
{
    use HasPackingList;

    public const STORAGE = self::SHIPMENT_STORAGE . '/bills/';
    protected $table = 'documents_shipment_bills';
}
