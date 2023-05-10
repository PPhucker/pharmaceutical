<?php

namespace App\Policies\Documents\Shipment\Protocols;

use App\Models\Auth\User;
use App\Models\Documents\Shipment\Protocols\Protocol;
use App\Policies\Documents\Shipment\ShipmentPolicy;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProtocolPolicy extends ShipmentPolicy
{
}
