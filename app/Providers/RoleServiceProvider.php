<?php

namespace App\Providers;

use App\Models\Auth\Role;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class RoleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        foreach (Role::pluck('slug') as $slug) {
            Blade::directive($slug, static function () use ($slug) {
                if (auth()->check() && auth()->user()->hasRole(collect($slug))) {
                    return "<?php if(true) : ?>";
                }
                return "<?php if(false) : ?>";
            });
            Blade::directive('end_' . $slug, static function () {
                return "<?php endif; ?>";
            });
        }
    }
}
