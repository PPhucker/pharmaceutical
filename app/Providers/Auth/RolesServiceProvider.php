<?php

namespace App\Providers\Auth;

use App\Models\Auth\Role;
use Blade;
use Illuminate\Support\ServiceProvider;

class RolesServiceProvider extends ServiceProvider
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
        $roles = Role::all()->pluck('slug');

        foreach ($roles as $role) {
            Blade::directive($role, static function () use ($role) {
                if (auth()->check() && auth()->user()->hasRole([$role])) {
                    return "<?php if(true) : ?>";
                }
                return "<?php if(false) : ?>";
            });
            Blade::directive('end_' . $role, static function () {
                return "<?php endif; ?>";
            });
        }
    }
}
