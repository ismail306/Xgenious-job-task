<?php

namespace App\Providers;

use App\Interfaces\CityInterface;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\CountryInterface;
use App\Interfaces\StateInterface;
use App\Repositories\CityRepository;
use App\Repositories\CountryRepository;
use App\Repositories\StateRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CountryInterface::class, CountryRepository::class);
        $this->app->bind(StateInterface::class, StateRepository::class);
        $this->app->bind(CityInterface::class, CityRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
