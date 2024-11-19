<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\CountryInterface;
use App\Interfaces\StateInterface;
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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
