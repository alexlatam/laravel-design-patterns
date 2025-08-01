<?php

namespace Transactions\OnRepositoryWithDecorator\Infrastructure\Repositories;

use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;
use Transactions\OnRepositoryWithDecorator\Domain\IUserRepository;
use Transactions\OnRepositoryWithDecorator\Domain\User;

readonly class TransactionalEloquentMysqlUserRepositoryDecorator implements IUserRepository
{
    public function __construct(
        private EloquentMysqlUserRepository $eloquentMysqlUserRepository,
    ){
    }

    /**
     * @throws Exception
     * @throws Throwable
     */
    public function store(User $user): void
    {
        try {
            DB::beginTransaction();
            $this->eloquentMysqlUserRepository->store($user);
            DB::commit();
        } catch (Exception|Throwable $e) {
            DB::rollBack();
            // Se lanza la misma excepción para que el controlador la capture y devuelva una respuesta adecuada
            throw $e;
        }
    }
}
