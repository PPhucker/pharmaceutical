<?php

namespace App\Models\Documents\Shipment\Appendixes;

use App\Models\Documents\Shipment\Shipment;
use App\Traits\Documents\Shipment\HasPackingList;

class Appendix extends Shipment
{
    use HasPackingList;

    public const STORAGE = self::SHIPMENT_STORAGE . '/appendixes/';
    protected $table = 'documents_shipment_appendixes';
}
