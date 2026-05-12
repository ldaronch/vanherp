<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\PageBanner;

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
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        View::composer('layouts.site', function ($view) {
            $routeName = request()->route()?->getName();

            $pageBanner = null;
            if (!empty($routeName)) {
                $pageBanner = PageBanner::query()
                    ->where('page', $routeName)
                    ->where('is_active', true)
                    ->orderByDesc('created_at')
                    ->first(['id', 'page', 'image', 'is_active']);
            }

            $view->with('pageBanner', $pageBanner);
        });
    }
}
