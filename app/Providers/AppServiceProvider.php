<?php

namespace App\Providers;

use App\Repositories\Implementations\GedungRepository;
use App\Repositories\Implementations\PeriodeRepository;
use App\Repositories\Interfaces\GedungRepositoryInterface;
use App\Repositories\Interfaces\PeriodeRepositoryInterface;
use App\Services\Implementations\GedungService;
use App\Services\Implementations\PeriodeService;
use App\Services\Interfaces\GedungServiceInterface;
use App\Services\Interfaces\PeriodeServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Service
        $this->app->bind(PeriodeServiceInterface::class, PeriodeService::class);
        $this->app->bind(GedungServiceInterface::class, GedungService::class);


        // Repository
        $this->app->bind(PeriodeRepositoryInterface::class, PeriodeRepository::class);
        $this->app->bind(GedungRepositoryInterface::class, GedungRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
