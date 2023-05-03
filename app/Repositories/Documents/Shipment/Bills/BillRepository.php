<?php

namespace App\Repositories\Documents\Shipment\Bills;

use App\Repositories\Documents\Shipment\ShipmentRepository;
use App\Models\Documents\Shipment\Bills\Bill as Model;

class BillRepository extends ShipmentRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}
