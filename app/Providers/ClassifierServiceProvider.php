<?php

namespace App\Providers;

use App\Models\Classifier\Bank;
use App\Models\Classifier\LegalForm;
use App\Models\Classifier\Region;
use App\Observers\Classifier\BankObserver;
use App\Observers\Classifier\LegalFormObserver;
use App\Observers\Classifier\RegionObserver;
use Illuminate\Support\ServiceProvider;

/**
 * Сервис провайдер классификаторов.
 */
class ClassifierServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        LegalForm::observe(LegalFormObserver::class);
    }
}
