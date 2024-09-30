<?php

namespace App\Models\Admin\Organization\Transport;

use App\Models\Contractor\Transport\Trailer as ContractorTrailer;
use App\Traits\Organization\Relation\HasOrganization;

/**
 * Модель прицепа организации.
 */
class Trailer extends ContractorTrailer
{
    use HasOrganization;

    protected $table = 'organizations_trailers';

    protected $fillable = [
        'user_id',
        'organization_id',
        'type',
        'state_number',
    ];
}
