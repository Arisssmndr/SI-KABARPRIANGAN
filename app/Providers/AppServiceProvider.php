<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        // // Tambahkan kode ini:
        // if ($this->app->environment('production')) {
        //     URL::forceScheme('https');
        // }

        Gate::define('role=Administrator', function ($user) {
            return $user->role === 'Administrator';
        });

        Gate::define('role=Admin', function ($user) {
            return $user->role === 'Admin';
        });
    }
}
