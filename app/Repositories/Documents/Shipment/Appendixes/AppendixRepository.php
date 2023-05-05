<?php

namespace App\Repositories\Documents\Shipment\Appendixes;

use App\Repositories\Documents\Shipment\ShipmentRepository;
use App\Models\Documents\Shipment\Appendixes\Appendix as Model;

class AppendixRepository extends ShipmentRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}
