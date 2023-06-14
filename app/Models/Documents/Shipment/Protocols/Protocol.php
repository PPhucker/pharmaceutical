<?php

namespace App\Models\Documents\Shipment\Protocols;

use App\Models\Documents\Shipment\Shipment;
use App\Traits\Documents\Shipment\HasPackingList;

class Protocol extends Shipment
{
    use HasPackingList;

    public const STORAGE = self::SHIPMENT_STORAGE . '/protocols/';
    protected $table = 'documents_shipment_protocols';
}
