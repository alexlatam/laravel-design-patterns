<?php

namespace App\Providers;

use App\Bus\Contracts\CommandBusInterface;
use App\Bus\Contracts\QueryBusInterface;
use App\Bus\IlluminateCommandBus;
use App\Bus\IlluminateQueryBus;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Modules\Sales\Commands\CreateSaleCommand;
use Modules\Sales\Commands\CreateSaleCommandHandler;
use Modules\Sales\Queries\FindSaleQuery;
use Modules\Sales\Queries\FindSaleQueryHandler;
use Modules\Sales\Repositories\Contracts\ReadSaleRepositoryInterface;
use Modules\Sales\Repositories\Contracts\WriteSaleRepositoryInterface;
use Modules\Sales\Repositories\ReadSaleRepository;
use Modules\Sales\Repositories\WriteSaleRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Registramos los singletons. En este caso solo tenemos 2 buses y 2 repositorios
        $singletons = [
            CommandBusInterface::class => IlluminateCommandBus::class,
            QueryBusInterface::class => IlluminateQueryBus::class,

            WriteSaleRepositoryInterface::class => WriteSaleRepository::class,
            ReadSaleRepositoryInterface::class => ReadSaleRepository::class,
        ];

        foreach ($singletons as $abstract => $concrete) {
            $this->app->singleton(
                abstract: $abstract,
                concrete: $concrete
            );
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        /**
         * Instanciamos el Command Bus, para mapear los commands con sus respectivos handlers
         * Estamos instanciando la interfaz, pero en realidad estamos instanciando la clase IlluminateCommandBus
         * --- Esto porque en el register, registramos el CommandBusInterface con la clase IlluminateCommandBus
         */
        $commandBus = app(CommandBusInterface::class);

        /**
         * Mapeamos los comandos con sus respectivos handlers
         * En este caso, solo tenemos el command CreateSaleCommand y el command handler CreateSaleCommandHandler
         * Esto quiere decir que cuando se despache el command CreateSaleCommand, se ejecutara el command handler CreateSaleCommandHandler
         * Y el command handler CreateSaleCommandHandler se encargara de ejecutar la lógica de negocio del command CreateSaleCommand
         * SIEMPRE la relación sera de 1 a 1 entre el Command y su Handler
         */
        $commandBus->register([
            CreateSaleCommand::class => CreateSaleCommandHandler::class,
        ]);

        /**
         * Instanciamos el Query Bus, para mapear los queries con sus respectivos handlers
         */
        $queryBus = app(QueryBusInterface::class);

        /**
         * Mapeamos los queries con sus respectivo handler
         * SIEMPRE la relación sera de 1 a 1 entre el Query y su Handler
         */
        $queryBus->register([
            FindSaleQuery::class => FindSaleQueryHandler::class,
        ]);
    }
}
