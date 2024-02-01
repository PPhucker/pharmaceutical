<?php

namespace App\Traits\Organization\Relation;

use App\Models\Admin\Organization\Organization;
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
