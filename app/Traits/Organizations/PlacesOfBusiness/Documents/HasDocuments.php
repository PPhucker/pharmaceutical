<?php

namespace App\Traits\Organizations\PlacesOfBusiness\Documents;

use App\Models\Documents\InvoicesForPayment\InvoiceForPayment;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasDocuments
{
    /**
     * @return HasMany
     */
    public function invoicesForPayment()
    {
        return $this->hasMany(InvoiceForPayment::class, 'organization_place_id')
            ->withTrashed();
    }
}
