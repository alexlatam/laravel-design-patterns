<?php

namespace Hex\Backoffice\Users\Infrastructure\ServiceProviders;

use Hex\Backoffice\Users\Application\CreateUserApplicationService;
use Hex\Backoffice\Users\Application\CreateUserCommand;
use Hex\Backoffice\Users\Application\CreateUserCommandHandler;
use Hex\Backoffice\Users\Domain\CommandBusInterface;
use Hex\Backoffice\Users\Domain\UserRepositoryInterface;
use Hex\Backoffice\Users\Infrastructure\Buses\IlluminateCommandBus;
use Hex\Backoffice\Users\Infrastructure\Persistence\Repositories\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class CreateUserCommandBusServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        /**
         * Registramos el CommandBusInterface con la clase IlluminateCommandBus
         * Esto para que cuando se instancie la interfaz, en realidad se instancie la clase IlluminateCommandBus
         */
        $this->app->singleton(
            abstract: CommandBusInterface::class,
            concrete: IlluminateCommandBus::class
        );

        $this->app
            ->when(CreateUserApplicationService::class)
            ->needs(UserRepositoryInterface::class)
            ->give(EloquentUserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $commandBus = app(CommandBusInterface::class);

        /**
         * Mapeamos el comando con su respectivo handler
         * SIEMPRE la relación sera de 1 a 1 entre el Command y su Handler
         */
        $commandBus->register([
            CreateUserCommand::class => CreateUserCommandHandler::class,
        ]);
    }
}
