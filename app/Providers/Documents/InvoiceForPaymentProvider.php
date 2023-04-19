<?php

namespace App\Providers\Documents;

use App\Models\Documents\InvoicesForPayment\InvoiceForPayment;
use App\Observers\Documents\InvoicesForPayment\InvoiceForPaymentObserver;
use Illuminate\Support\ServiceProvider;

class InvoiceForPaymentProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        InvoiceForPayment::observe(InvoiceForPaymentObserver::class);
    }
}
