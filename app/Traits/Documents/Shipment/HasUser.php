<?php

namespace App\Traits\Documents\Shipment;

use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasUser
{
    /**
     * @return BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id')
            ->withTrashed();
    }

    /**
     * @return BelongsTo
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by_id')
            ->withTrashed();
    }

    /**
     * @return BelongsTo
     */
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by_id')
            ->withTrashed();
    }
}
