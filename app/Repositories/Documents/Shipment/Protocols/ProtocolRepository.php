<?php

namespace App\Repositories\Documents\Shipment\Protocols;

use App\Repositories\Documents\Shipment\ShipmentRepository;
use App\Models\Documents\Shipment\Protocols\Protocol as Model;

class ProtocolRepository extends ShipmentRepository
{

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}
