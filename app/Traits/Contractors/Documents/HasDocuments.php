<?php

namespace App\Traits\Contractors\Documents;

use App\Models\Documents\InvoicesForPayment\InvoiceForPayment;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasDocuments
{
    /**
     * @return HasMany
     */
    public function invoicesForPayment()
    {
        return $this->hasMany(InvoiceForPayment::class, 'contractor_id')
            ->withTrashed();
    }
}
