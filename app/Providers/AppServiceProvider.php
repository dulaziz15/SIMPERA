<?php

namespace App\Providers;

use App\Repositories\Implementations\PeriodeRepository;
use App\Repositories\Interfaces\PeriodeRepositoryInterface;
use App\Services\Implementations\PeriodeService;
use App\Services\Interfaces\PeriodeServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PeriodeServiceInterface::class, PeriodeService::class);
        $this->app->bind(PeriodeRepositoryInterface::class, PeriodeRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
