<?php

namespace App\Providers\Contractors;

use App\Models\Contractors\Car;
use App\Models\Contractors\ContactPerson;
use App\Models\Contractors\Contract;
use App\Models\Contractors\Contractor;
use App\Models\Contractors\Driver;
use App\Models\Contractors\Trailer;
use App\Observers\Contractors\CarObserver;
use App\Observers\Contractors\ContactPersonObserver;
use App\Observers\Contractors\ContractObserver;
use App\Observers\Contractors\ContractorObserver;
use App\Observers\Contractors\DriverObserver;
use App\Observers\Contractors\TrailerObserver;
use App\Services\Contractor\ContractorService;
use Illuminate\Support\ServiceProvider;

/**
 * Сервис провайдер контрагента.
 */
class ContractorServiceProvider extends ServiceProvider
{
    protected $providers = [
        AddressServiceProvider::class,
        BankServiceProvider::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(ContractorService::class);

        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        Contractor::observe(ContractorObserver::class);

        ContactPerson::observe(ContactPersonObserver::class);

        Driver::observe(DriverObserver::class);
        Car::observe(CarObserver::class);
        Trailer::observe(TrailerObserver::class);

        Contract::observe(ContractObserver::class);
    }
}
