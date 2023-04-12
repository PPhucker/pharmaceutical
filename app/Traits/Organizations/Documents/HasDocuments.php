<?php

namespace App\Traits\Organizations\Documents;

use App\Models\Documents\InvoiceForPayment;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasDocuments
{
    /**
     * @return HasMany
     */
    public function invoicesForPayment()
    {
        return $this->hasMany(InvoiceForPayment::class, 'organization_id')
            ->withTrashed();
    }
}
