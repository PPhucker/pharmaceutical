<?php

namespace App\Repositories\Documents\Shipment\Waybills;

use App\Repositories\Documents\Shipment\ShipmentRepository;
use App\Models\Documents\Shipment\Waybills\Waybill as Model;

class WaybillRepository extends ShipmentRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}
