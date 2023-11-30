<?php

namespace App\Traits\Document;

use App\Models\Documents\InvoicesForPayment\InvoiceForPayment;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Отношение к счетам на оплату.
 */
trait HasInvoicesForPayment
{
    /**
     * Счета на оплату, связанные с контрагентом.
     *
     * @return HasMany
     */
    public function invoicesForPayment(): HasMany
    {
        return $this->hasMany(InvoiceForPayment::class, $this->foreign_key)
            ->withTrashed();
    }
}
