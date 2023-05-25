<?php

namespace App\Traits\Organizations\Documents;

use App\Models\Documents\Acts\Act;
use App\Models\Documents\InvoicesForPayment\InvoiceForPayment;
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

    /**
     * @return HasMany
     */
    public function acts()
    {
        return $this->hasMany(Act::class, 'organization_id');
    }
}
