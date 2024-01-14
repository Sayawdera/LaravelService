<?php

namespace App\Providers;

use App\Interfaces\IBaseRepository;
use App\Interfaces\IBaseService;
use App\Repositories\BaseRepository;
use App\Services\BaseService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local'))
        {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

        $this->app->bind(IBaseRepository::class, BaseRepository::class);
        $this->app->bind(IBaseService::class, BaseService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
