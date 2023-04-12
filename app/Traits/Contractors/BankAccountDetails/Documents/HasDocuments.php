<?php

namespace App\Traits\Contractors\BankAccountDetails\Documents;

use App\Models\Documents\InvoiceForPayment;

trait HasDocuments
{
    public function invoicesForPayment()
    {
        return $this->hasMany(InvoiceForPayment::class, 'contractor_bank_id')
            ->withTrashed();
    }
}
