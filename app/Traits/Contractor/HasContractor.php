<?php

namespace App\Traits\Contractor;

use App\Models\Contractor\Contractor;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Связь с контагентом.
 */
trait HasContractor
{
    /**
     * @return BelongsTo
     */
    public function contractor(): BelongsTo
    {
        return $this->belongsTo(Contractor::class)
            ->withTrashed();
    }

}
