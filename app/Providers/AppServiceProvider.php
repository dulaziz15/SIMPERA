<?php

namespace App\Providers;

use App\Repositories\Implementations\FasilitasRepository;
use App\Repositories\Implementations\FeedbackRepository;
use App\Repositories\Implementations\GedungRepository;
use App\Repositories\Implementations\KategoriFasilitasRepository;
use App\Repositories\Implementations\KategoriGedungRepository;
use App\Repositories\Implementations\LogActivityRepository;
use App\Repositories\Implementations\PelaporanRepository;
use App\Repositories\Implementations\PendukungRepository;
use App\Repositories\Implementations\PenugasanRepository;
use App\Repositories\Implementations\PeranRepository;
use App\Repositories\Implementations\PeriodeRepository;
use App\Repositories\Implementations\ProfilRepository;
use App\Repositories\Implementations\RuanganRepository;
use App\Repositories\Interfaces\FasilitasRepositoryInterface;
use App\Repositories\Interfaces\FeedbackRepositoryInterface;
use App\Repositories\Implementations\UserRepository;
use App\Repositories\Interfaces\GedungRepositoryInterface;
use App\Repositories\Interfaces\KategoriFasilitasRepositoryInterface;
use App\Repositories\Interfaces\KategoriGedungRepositoryInterface;
use App\Repositories\Interfaces\LogActivityRepositoryInterface;
use App\Repositories\Interfaces\PelaporanRepositoryInterface;
use App\Repositories\Interfaces\PendukungRepositoryInterface;
use App\Repositories\Interfaces\PenugasanRepositoryInterface;
use App\Repositories\Interfaces\PeranRepositoryInterface;
use App\Repositories\Interfaces\PeriodeRepositoryInterface;
use App\Repositories\Interfaces\ProfilRepositoryInterface;
use App\Repositories\Interfaces\RuanganRepositoryInterface;
use App\Services\Implementations\FasilitasService;
use App\Services\Implementations\FeedbackService;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Implementations\GedungService;
use App\Services\Implementations\KategoriFasilitasService;
use App\Services\Implementations\KategoriGedungService;
use App\Services\Implementations\LogActivityService;
use App\Services\Implementations\PelaporanService;
use App\Services\Implementations\PendukungService;
use App\Services\Implementations\PenugasanService;
use App\Services\Implementations\PeranService;
use App\Services\Implementations\PeriodeService;
use App\Services\Implementations\ProfilService;
use App\Services\Implementations\RuanganService;
use App\Services\Implementations\SpkService;
use App\Services\Interfaces\FasilitasServiceInterface;
use App\Services\Interfaces\FeedbackServiceInterface;
use App\Services\Implementations\UserService;
use App\Services\Interfaces\GedungServiceInterface;
use App\Services\Interfaces\KategoriFasilitasServiceInterface;
use App\Services\Interfaces\KategoriGedungServiceInterface;
use App\Services\Interfaces\LogActivityServiceInterface;
use App\Services\Interfaces\PelaporanServiceInterface;
use App\Services\Interfaces\PendukungServiceInterface;
use App\Services\Interfaces\PenugasanServiceInterface;
use App\Services\Interfaces\Peran;
use App\Services\Interfaces\PeranServiceInterface;
use App\Services\Interfaces\PeriodeServiceInterface;
use App\Services\Interfaces\ProfilServiceInterface;
use App\Services\Interfaces\RuanganServiceInterface;
use App\Services\Interfaces\SpkServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
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
        $this->app->bind(KategoriFasilitasServiceInterface::class, KategoriFasilitasService::class);
        $this->app->bind(PeranServiceInterface::class, PeranService::class);
        $this->app->bind(LogActivityServiceInterface::class, LogActivityService::class);
        $this->app->bind(FasilitasServiceInterface::class, FasilitasService::class);
        $this->app->bind(PelaporanServiceInterface::class, PelaporanService::class);
        $this->app->bind(FeedbackServiceInterface::class, FeedbackService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(KategoriGedungServiceInterface::class, KategoriGedungService::class);
        $this->app->bind(RuanganServiceInterface::class, RuanganService::class);
        $this->app->bind(ProfilServiceInterface::class, ProfilService::class);
        $this->app->bind(PendukungServiceInterface::class, PendukungService::class);
        $this->app->bind(PenugasanServiceInterface::class, PenugasanService::class);
        $this->app->bind(SpkServiceInterface::class, SpkService::class);
        

        // Repository
        $this->app->bind(PeriodeRepositoryInterface::class, PeriodeRepository::class);
        $this->app->bind(GedungRepositoryInterface::class, GedungRepository::class);
        $this->app->bind(KategoriFasilitasRepositoryInterface::class, KategoriFasilitasRepository::class);
        $this->app->bind(PeranRepositoryInterface::class, PeranRepository::class);
        $this->app->bind(LogActivityRepositoryInterface::class, LogActivityRepository::class);
        $this->app->bind(FasilitasRepositoryInterface::class, FasilitasRepository::class);
        $this->app->bind(PelaporanRepositoryInterface::class, PelaporanRepository::class);
        $this->app->bind(FeedbackRepositoryInterface::class, FeedbackRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(KategoriGedungRepositoryInterface::class, KategoriGedungRepository::class);
        $this->app->bind(RuanganRepositoryInterface::class, RuanganRepository::class);
        $this->app->bind(ProfilRepositoryInterface::class, ProfilRepository::class);
        $this->app->bind(PendukungRepositoryInterface::class, PendukungRepository::class);
        $this->app->bind(PenugasanRepositoryInterface::class, PenugasanRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
