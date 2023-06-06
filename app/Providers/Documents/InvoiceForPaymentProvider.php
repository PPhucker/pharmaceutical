<?php

namespace App\Providers\Documents;

use App\Models\Documents\InvoicesForPayment\InvoiceForPayment;
use App\Models\Documents\InvoicesForPayment\InvoiceForPaymentMaterial;
use App\Models\Documents\InvoicesForPayment\InvoiceForPaymentProduct;
use App\Observers\Documents\InvoicesForPayment\InvoiceForPaymentMaterialObserver;
use App\Observers\Documents\InvoicesForPayment\InvoiceForPaymentObserver;
use App\Observers\Documents\InvoicesForPayment\InvoiceForPaymentProductObserver;
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
        InvoiceForPaymentProduct::observe(InvoiceForPaymentProductObserver::class);
        InvoiceForPaymentMaterial::observe(InvoiceForPaymentMaterialObserver::class);
    }
}
