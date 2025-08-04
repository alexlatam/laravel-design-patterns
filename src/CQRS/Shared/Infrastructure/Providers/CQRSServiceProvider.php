<?php

namespace CQRS\Shared\Infrastructure\Providers;

use CQRS\Products\Infrastructure\ServiceProviders\CQRSProductsServiceProvider;
use Illuminate\Support\ServiceProvider;

final class CQRSServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(CQRSProductsServiceProvider::class);
    }
}



