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
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share currency symbol with all views
        // Wrapped in try-catch for tests/migrations where table might not exist
        try {
            view()->composer('*', function ($view) {
                // Check if table exists first to avoid SQL errors during fresh migrations
                if (\Illuminate\Support\Facades\Schema::hasTable('site_settings')) {
                    $currencySymbol = \App\Models\SiteSetting::where('key', 'currency_symbol')->value('value') ?? '$';
                } else {
                    $currencySymbol = '$';
                }
                $view->with('currency', $currencySymbol);
            });
        } catch (\Exception $e) {
            // Fallback for when DB isn't ready
        }
    }
}
