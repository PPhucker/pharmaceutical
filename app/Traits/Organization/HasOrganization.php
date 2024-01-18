<?php

namespace App\Traits\Organization;

use App\Models\Admin\Organizations\Organization;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasOrganization
{
    /**
     * @return BelongsTo
     */
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id')
            ->withTrashed();
    }
}