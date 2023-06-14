<?php

namespace App\Providers;

use App\Mixins\StrMixin;
use App\Models\Auth\User;
use App\Observers\Admin\UserObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use ReflectionException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     * @throws ReflectionException
     */
    public function boot()
    {
        Str::mixin(new StrMixin);
        User::observe(UserObserver::class);
    }
}
