<?php

namespace Transactions\Infrastructure\Repositories;

use Exception;
use Illuminate\Support\Facades\DB;
use Transactions\Domain\IUserRepository;
use Transactions\Domain\User;

readonly class TransactionalEloquentMysqlUserRepositoryDecorator implements IUserRepository
{
    public function __construct(
        private EloquentMysqlUserRepository $eloquentMysqlUserRepository,
    ){
    }

    /**
     * @throws Exception
     */
    public function store(User $user): void
    {
        try {
            DB::beginTransaction();
            $this->eloquentMysqlUserRepository->store($user);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            // Se lanza la misma excepción para que el controlador la capture y devuelva una respuesta adecuada
            throw $e;
        }
    }
}
