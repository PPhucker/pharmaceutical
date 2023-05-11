<?php

namespace App\Providers\Contractors;

use App\Models\Admin\Organizations\BankAccountDetail;
use App\Models\Admin\Organizations\Driver;
use App\Models\Admin\Organizations\Organization;
use App\Models\Admin\Organizations\PlaceOfBusiness;
use App\Models\Admin\Organizations\Staff;
use App\Observers\Admin\Organizations\BankAccountDetailObserver;
use App\Observers\Admin\Organizations\DriverObserver;
use App\Observers\Admin\Organizations\OrganizationObserver;
use App\Observers\Admin\Organizations\PlaceOfBusinessObserver;
use App\Observers\Admin\Organizations\StaffObserver;
use Illuminate\Support\ServiceProvider;

class OrganizationServiceProvider extends ServiceProvider
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
        Organization::observe(OrganizationObserver::class);
        PlaceOfBusiness::observe(PlaceOfBusinessObserver::class);
        BankAccountDetail::observe(BankAccountDetailObserver::class);
        Staff::observe(StaffObserver::class);
        Driver::observe(DriverObserver::class);
    }
}
