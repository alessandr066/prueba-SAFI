<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /**
         * Directiva Blade para validar uno o varios roles.
         * Uso:
         * @role("Administrador")
         * @role("Decano Facultad,Encargado UAF-Facultad")
         */
        Blade::directive('role', function ($roles) {
            return "<?php
        \$currentRole = auth()->user()->rol->nombre ?? null;
        \$allowedRoles = array_map('trim', explode(',', str_replace(\"'\", '', $roles)));
        if(in_array(\$currentRole, \$allowedRoles)):
    ?>";
        });

        Blade::directive('endrole', function () {
            return "<?php endif; ?>";
        });
    }
}
