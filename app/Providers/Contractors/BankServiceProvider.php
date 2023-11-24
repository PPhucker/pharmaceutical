<?php

namespace App\Providers\Contractors;

use App\Models\Classifiers\Bank;
use App\Models\Contractors\BankAccountDetail;
use App\Observers\Classifiers\BankObserver;
use App\Observers\Contractors\BankAccountDetailObserver;
use App\Services\Contractor\Bank\BankServiceDependencies;
use Illuminate\Support\ServiceProvider;

/**
 * Сервис провайдер банка контрагента.
 */
class BankServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BankServiceDependencies::class);
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        BankAccountDetail::observe(BankAccountDetailObserver::class);
        Bank::observe(BankObserver::class);
    }
}
