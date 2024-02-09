<?php

namespace App\Providers\Contractor;

use App\Models\Classifier\Bank;
use App\Models\Contractor\BankAccountDetail;
use App\Observers\CoreObserver;
use App\Services\Contractor\Bank\BankServiceDependencies;
use Illuminate\Support\ServiceProvider;

/**
 * Сервис провайдер банка контрагента.
 */
class BankServiceProvider extends ServiceProvider
{
    protected $coreObservedModels = [
        BankAccountDetail::class,
        Bank::class,
    ];

    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton(BankServiceDependencies::class);
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        foreach ($this->coreObservedModels as $model) {
            $model::observe(CoreObserver::class);
        }
    }
}
