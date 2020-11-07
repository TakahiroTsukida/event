<?php

namespace App\Providers;

use App\Services\Admin\AdminService;
use App\Services\Admin\AdminServiceInterface;
use App\Services\City\CityService;
use App\Services\City\CityServiceInterface;
use App\Services\Event\EventService;
use App\Services\Event\EventServiceInterface;
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
        $this->app->singleton(EventServiceInterface::class, EventService::class);
        $this->app->singleton(AdminServiceInterface::class, AdminService::class);
        $this->app->singleton(CityServiceInterface::class, CityService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
