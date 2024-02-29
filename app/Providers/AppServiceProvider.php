<?php

namespace App\Providers;

use App\Repositories\SalesRepository;
use App\Services\SalesService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SalesService::class, function ($app) {
            return new SalesService(new SalesRepository);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
