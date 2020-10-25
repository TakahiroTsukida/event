<?php

namespace App\Providers;

use App\Repositories\Contracts\EventContract;
use App\Repositories\Eloquents\EloquentEventRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bindings of models
     *
     * @var array
     */
    public $models = [
        'Admin',
        'Event',
        'Shop',
        'Price',
        'Schedule',
        'Capa',
        'Tag',
    ];


    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->bind(EventContract::class, EloquentEventRepository::class);
        // Abstract repositories bind concrete one.
        foreach ($this->models as $model) {
            $this->app->bind(
                "App\Repositories\Contracts\\{$model}Contract",
                "App\Repositories\Eloquents\Eloquent{$model}Repository"
            );
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
