<?php

namespace CQRS\Products\Infrastructure\ServiceProviders;

use CQRS\Products\Application\Create\CreateProductCommand;
use CQRS\Products\Application\Create\CreateProductCommandHandler;
use CQRS\Products\Application\Find\FindProductQuery;
use CQRS\Products\Application\Find\FindProductQueryHandler;
use CQRS\Products\Domain\Repositories\ProductRepositoryInterface;
use CQRS\Products\Infrastructure\Buses\IlluminateCommandBus;
use CQRS\Products\Infrastructure\Buses\IlluminateQueryBus;
use CQRS\Shared\Domain\Bus\Commands\CommandBusInterface;
use CQRS\Shared\Domain\Bus\Queries\QueryBusInterface;
use Illuminate\Support\ServiceProvider;

class CQRSServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Registramos los singletons. En este caso solo tenemos 2 buses y 2 repositorios
        $singletons = [
            CommandBusInterface::class => IlluminateCommandBus::class,
            QueryBusInterface::class => IlluminateQueryBus::class,

            ProductRepositoryInterface::class => ProductRepositoryInterface::class,
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
            CreateProductCommand::class => CreateProductCommandHandler::class,
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
            FindProductQuery::class => FindProductQueryHandler::class,
        ]);
    }
}
