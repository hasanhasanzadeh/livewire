<?php

namespace App\Providers;

use App\Repositories\ArticleRepository;
use App\Repositories\InterfaceRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(InterfaceRepository::class, ArticleRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
