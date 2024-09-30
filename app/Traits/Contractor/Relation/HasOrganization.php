<?php

namespace App\Traits\Contractor\Relation;

use App\Models\Admin\Organization\Organization;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Трейт отношения к организации.
 */
trait HasOrganization
{
    /**
     * @return BelongsTo
     */
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }
}
