<?php

namespace App\Providers;

use App\Models\Classifiers\Bank;
use App\Models\Classifiers\LegalForm;
use App\Observers\Classifiers\BankObserver;
use App\Observers\Classifiers\LegalFormObserver;
use Illuminate\Support\ServiceProvider;

class ClassifierServiceProvider extends ServiceProvider
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
        LegalForm::observe(LegalFormObserver::class);
        Bank::observe(BankObserver::class);
    }
}
