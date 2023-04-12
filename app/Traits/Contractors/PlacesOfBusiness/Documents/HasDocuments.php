<?php

namespace App\Traits\Contractors\PlacesOfBusiness\Documents;

use App\Models\Documents\InvoiceForPayment;

trait HasDocuments
{
    public function invoicesForPayment()
    {
        return $this->hasMany(InvoiceForPayment::class, 'contractor_place_id')
            ->withTrashed();
    }
}
