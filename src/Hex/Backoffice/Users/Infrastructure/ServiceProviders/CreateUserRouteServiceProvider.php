<?php

namespace Hex\Backoffice\Users\Infrastructure\ServiceProviders;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class CreateUserRouteServiceProvider extends ServiceProvider
{
    protected string $controllerNamespace = 'Hex\Backoffice\Users\Infrastructure\Controllers';

    public function map(): void
    {
        $this->mapRoutes();
    }

    public function mapRoutes(): void
    {
        Route::prefix('api')
            ->namespace($this->controllerNamespace)
            ->group(base_path('src/Hex/Backoffice/Users/Infrastructure/Routes/api.php'));
    }
}
