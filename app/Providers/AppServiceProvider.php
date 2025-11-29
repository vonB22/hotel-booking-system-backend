<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Prevent any container resolution issues
        // by ensuring essential services are properly available
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Ensure proper permissions on storage directories
        @chmod(storage_path(), 0775);
        @chmod(storage_path('logs'), 0775);
        @chmod(storage_path('framework'), 0775);
    }
}
