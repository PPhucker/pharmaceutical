<?php

namespace App\Providers\Contractors;

use App\Models\Contractors\ContactPerson;
use App\Models\Contractors\Contract;
use App\Models\Contractors\Contractor;
use App\Observers\Contractors\ContractorObserver;
use App\Observers\CoreObserver;
use App\Services\Contractor\ContractorService;
use Illuminate\Support\ServiceProvider;

/**
 * Сервис провайдер контрагента.
 */
class ContractorServiceProvider extends ServiceProvider
{
    /**
     * @var string[]
     */
    protected $providers = [
        AddressServiceProvider::class,
        BankServiceProvider::class,
        TransportServiceProvider::class
    ];

    /**
     * @var string[]
     */
    protected $coreObservedModels = [
        Contract::class,
        ContactPerson::class,
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

        foreach ($this->coreObservedModels as $model) {
            $model::observe(CoreObserver::class);
        }
    }
}
