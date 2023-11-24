<?php

namespace App\Providers;

use App\Models\Classifiers\Bank;
use App\Models\Classifiers\LegalForm;
use App\Models\Classifiers\Region;
use App\Observers\Classifiers\BankObserver;
use App\Observers\Classifiers\LegalFormObserver;
use App\Observers\Classifiers\RegionObserver;
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
