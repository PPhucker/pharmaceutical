<?php

namespace App\Providers;

use App\Models\Auth\Permission;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('permissions')) {
            foreach (Permission::pluck('slug') as $slug) {
                Blade::directive($slug, static function () use ($slug) {
                    if (auth()->check() && auth()->user()->hasPermission(collect($slug))) {
                        return "<?php if(true) : ?>";
                    }
                    return "<?php if(false) : ?>";
                });
                Blade::directive('end_' . $slug, static function () {
                    return "<?php endif; ?>";
                });
            }
            Blade::directive('permissions', static function ($permissions) {
                return "<?php if(auth()->check() && auth()->user()->hasPermission({$permissions})) : ?>";
            });

            Blade::directive('end_permissions', static function () {
                return "<?php endif; ?>";
            });
        }
    }
}
