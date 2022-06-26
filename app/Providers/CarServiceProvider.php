<?php

namespace App\Providers;

use App\Repositories\CarRepository;
use App\Repositories\CarRepositoryInterface;
use App\Services\CarService;
use App\Services\CarServiceInterface;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class CarServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CarServiceInterface::class, CarService::class);
        $this->app->bind(CarRepositoryInterface::class, CarRepository::class);
    }

    public function provides()
    {
        return [
            CarServiceInterface::class,
            CarRepositoryInterface::class,
        ];
    }
}
