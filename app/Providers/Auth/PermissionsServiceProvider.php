<?php

namespace App\Providers\Auth;

use App\Models\Auth\Permission;
use Blade;
use Illuminate\Support\ServiceProvider;

class PermissionsServiceProvider extends ServiceProvider
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
        $permissions = Permission::all()->pluck('slug')->except('all');

        foreach ($permissions as $permission) {
            Blade::directive($permission, static function () use ($permission) {
                if (auth()->check() && auth()->user()->hasPermission([$permission])) {
                    return "<?php if(true) : ?>";
                }
                return "<?php if(false) : ?>";
            });
            Blade::directive('end_' . $permission, static function () {
                return "<?php endif; ?>";
            });
        }
    }
}
