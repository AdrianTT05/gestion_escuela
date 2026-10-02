<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Interfaz\ProfesorRepositoryInterface;
use App\Repositories\Eloquent\ProfesorEloquentRepository;
use App\Repositories\Db\ProfesorDbRepository;
use App\Services\Interfaz\ProfesorServiceInterface;
use App\Services\ProfesorService;
use App\Repositories\Interfaz\ModulosRepositoryInterface;
use App\Repositories\Eloquent\ModulosEloquentRepository;
use App\Repositories\Db\ModulosDbRepository;
use App\Services\Interfaz\ModulosServiceInterface;
use App\Services\ModulosService;
use App\Services\Interfaz\InformeServiceInterface;
use App\Services\InformeService;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Si alguien pide la interfaz, dale esta clase
        $this->app->bind(ProfesorRepositoryInterface::class, ProfesorEloquentRepository::class);
        // $this->app->bind(ProfesorRepositoryInterface::class, ProfesorDbRepository::class);
        $this->app->bind(ProfesorServiceInterface::class, ProfesorService::class);

        $this->app->bind(ModulosRepositoryInterface::class, ModulosEloquentRepository::class);
        // $this->app->bind(ModulosRepositoryInterface::class, ModulosDbRepository::class);
        $this->app->bind(ModulosServiceInterface::class, ModulosService::class);

        $this->app->bind(InformeServiceInterface::class, InformeService::class);

    }

    public function boot(): void
    {
        //
    }
}
