<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting;
use App\Helpers\ImageHelper;

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
        // Share settings to all views
        View::composer('*', function ($view) {
            $settings = Setting::pluck('value', 'key')->toArray();
            $view->with('settings', $settings);
        });
        
        // Share ImageHelper to all views
        View::share('ImageHelper', ImageHelper::class);
    }
}
