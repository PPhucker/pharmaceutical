<?php

namespace App\Traits\Organization\Relation;

use App\Models\Admin\Organization\Organization;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HasOrganizations
{
    /**
     * @return HasMany
     */
    public function organizations(): HasMany
    {
        return $this->hasMany(Organization::class, $this->foreign_key)
            ->withTrashed();
    }
}
