<?php

namespace App\Models\Admin\Organization\Transport;

use App\Traits\Organization\Relation\HasOrganization;
use App\Models\Contractor\Transport\Driver as ContractorDriver;

/**
 * Модель водителя организации.
 */
class Driver extends ContractorDriver
{
    use HasOrganization;

    protected $table = 'organizations_drivers';

    protected $fillable = [
        'user_id',
        'organization_id',
        'name',
    ];
}
