<?php

namespace App\Providers;

use App\Site;
use App\Clinic;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        $clinics = Clinic::all();
        $site  = Site::first();
        view()->share(['site' => $site, 'clinics' => $clinics]);

    }
}
