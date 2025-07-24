<?php

namespace DDD\RealExample\Shared\Infrastructure\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

final class DDDRouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        parent::boot();
    }

    public function map(): void
    {
        $this->mapRoutes();
    }

    public function mapRoutes(): void
    {
        Route::prefix('api')
            ->namespace('DDD\RealExample\User\Infrastructure\Controllers')
            ->group(base_path('src/DDD/RealExample/User/Infrastructure/Routes/api.php'));
    }
}

