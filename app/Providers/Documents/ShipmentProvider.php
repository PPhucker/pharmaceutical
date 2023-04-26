<?php

namespace App\Providers\Documents;

use App\Models\Documents\Shipment\PackingLists\PackingList;
use App\Models\Documents\Shipment\PackingLists\PackingListProduct;
use App\Observers\Documents\Shipment\PackingLists\PackingListObserver;
use App\Observers\Documents\Shipment\PackingLists\PackingListProductObserver;
use Illuminate\Support\ServiceProvider;

class ShipmentProvider extends ServiceProvider
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
        PackingList::observe(PackingListObserver::class);
        PackingListProduct::observe(PackingListProductObserver::class);
    }
}
