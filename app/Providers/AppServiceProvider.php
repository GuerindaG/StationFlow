<?php

namespace App\Providers;

use App\Models\Categorie;
use App\Models\Paiement;
use App\Models\Station;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\UrlGenerator;

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
    public function boot(UrlGenerator $url): void
    {
        if (env('APP_ENV') === 'production') {
            $url->forceScheme('https');
        }

        Schema::defaultStringLength(191);

        View::share('stations', Station::all());
        View::share('paiements', Paiement::all());
        View::share('categories', Categorie::all());

        View::composer('*', function ($view) {
            if (Auth::check()) {
                $view->with('notifications', Auth::user()->unreadNotifications);
            }
        });
    }
}
