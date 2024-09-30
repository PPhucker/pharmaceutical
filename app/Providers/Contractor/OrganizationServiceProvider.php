<?php

namespace App\Providers\Contractor;

use App\Models\Admin\Organization\BankAccountDetail;
use App\Models\Admin\Organization\Organization;
use App\Models\Admin\Organization\PlaceOfBusiness;
use App\Models\Admin\Organization\Staff;
use App\Models\Admin\Organization\Transport\Car;
use App\Models\Admin\Organization\Transport\Driver;
use App\Models\Admin\Organization\Transport\Trailer;
use App\Observers\CoreObserver;
use App\Services\Admin\Organization\OrganizationService;
use Illuminate\Support\ServiceProvider;

/**
 * Сервис провайдер организации.
 */
class OrganizationServiceProvider extends ServiceProvider
{
    protected $observedModels = [
        Organization::class,
        PlaceOfBusiness::class,
        BankAccountDetail::class,
        Staff::class,
        Driver::class,
        Car::class,
        Trailer::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(OrganizationService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        foreach ($this->observedModels as $model) {
            $model::observe(CoreObserver::class);
        }
    }
}
