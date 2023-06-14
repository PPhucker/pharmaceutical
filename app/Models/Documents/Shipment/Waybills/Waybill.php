<?php

namespace App\Models\Documents\Shipment\Waybills;

use App\Models\Documents\Shipment\Shipment;
use App\Traits\Documents\Shipment\HasPackingList;

class Waybill extends Shipment
{
    use HasPackingList;

    public const STORAGE = self::SHIPMENT_STORAGE . '/waybills/';

    protected $table = 'documents_shipment_waybills';

    protected $fillable = [
        'created_by_id',
        'updated_by_id',
        'approved_by_id',
        'packing_list_id',
        'number',
        'date',
        'approved',
        'comment',
        'filename',
        'approved_at',
        'car_model',
        'state_car_number',
        'driver',
        'licence_card',
        'type_of_transportation',
        'trailer_1',
        'trailer_2',
        'state_trailer_1_number',
        'state_trailer_2_number',
    ];
}
