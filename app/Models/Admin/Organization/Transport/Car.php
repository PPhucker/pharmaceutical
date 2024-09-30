<?php

namespace App\Models\Admin\Organization\Transport;

use App\Traits\Organization\Relation\HasOrganization;
use App\Models\Contractor\Transport\Car as ContractorCar;

/**
 * Модель автомобиля организации.
 */
class Car extends ContractorCar
{
    use HasOrganization;

    protected $table = 'organizations_cars';

    protected $fillable = [
        'user_id',
        'organization_id',
        'car_model',
        'state_number',
    ];
}
