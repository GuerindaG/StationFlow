<?php

namespace App\Providers;

use App\Models\Categorie;
use App\Models\Paiement;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Station;

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
        Schema::defaultStringLength(191);
        View::share('stations', Station::all());
        View::share('paiements', Paiement::all());
        View::share('categories', Categorie::all());
    }
}
