<?php

namespace App\Providers\Contractors;

use App\Models\Contractors\BankAccountDetail;
use App\Models\Contractors\Car;
use App\Models\Contractors\ContactPerson;
use App\Models\Contractors\Contractor;
use App\Models\Contractors\Driver;
use App\Models\Contractors\PlaceOfBusiness;
use App\Models\Contractors\Trailer;
use App\Observers\Contractors\BankAccountDetailObserver;
use App\Observers\Contractors\CarObserver;
use App\Observers\Contractors\ContactPersonObserver;
use App\Observers\Contractors\ContractorObserver;
use App\Observers\Contractors\DriverObserver;
use App\Observers\Contractors\PlaceOfBusinessObserver;
use App\Observers\Contractors\TrailerObserver;
use Illuminate\Support\ServiceProvider;

class ContractorServiceProvider extends ServiceProvider
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
        Contractor::observe(ContractorObserver::class);
        PlaceOfBusiness::observe(PlaceOfBusinessObserver::class);
        BankAccountDetail::observe(BankAccountDetailObserver::class);
        ContactPerson::observe(ContactPersonObserver::class);
        Driver::observe(DriverObserver::class);
        Car::observe(CarObserver::class);
        Trailer::observe(TrailerObserver::class);
    }
}
