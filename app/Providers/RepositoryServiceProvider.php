<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\CountryInterface;
use App\Repositories\CountryRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(CountryInterface::class, CountryRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
