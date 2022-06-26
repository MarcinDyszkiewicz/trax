<?php

namespace App\Providers;

use App\Repositories\TripRepository;
use App\Repositories\TripRepositoryInterface;
use App\Services\TripService;
use App\Services\TripServiceInterface;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class TripServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TripServiceInterface::class, TripService::class);
        $this->app->bind(TripRepositoryInterface::class, TripRepository::class);
    }

    public function provides()
    {
        return [
            TripServiceInterface::class,
            TripRepositoryInterface::class,
        ];
    }
}
