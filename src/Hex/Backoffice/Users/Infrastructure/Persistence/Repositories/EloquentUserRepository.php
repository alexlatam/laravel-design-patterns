<?php

namespace Hex\Backoffice\Users\Infrastructure\Persistence\Repositories;

use Hex\Backoffice\Users\Domain\Exceptions\UserAlreadyExistsException;
use Hex\Backoffice\Users\Domain\Exceptions\UserNotFoundException;
use Hex\Backoffice\Users\Domain\User as UserEntity;
use Hex\Backoffice\Users\Domain\UserRepositoryInterface;
use Hex\Backoffice\Users\Infrastructure\Persistence\Models\User;

class EloquentUserRepository implements UserRepositoryInterface
{
    protected User $eloquentModel;

    public function __construct()
    {
        $this->eloquentModel = new User;
    }

    /**
     * @throws UserNotFoundException
     */
    public function findOrFail(string $id): UserEntity
    {
        $user = $this->eloquentModel->find($id);

        if (is_null($user)) {
            throw new UserNotFoundException('User not found');
        }

        return $this->mapToEntity($user);
    }

    /**
     * @throws UserAlreadyExistsException
     */
    public function save(UserEntity $user): void
    {
        $eloquentModel = $this->eloquentModel->find($user->getId());

        if (!is_null($eloquentModel)) {
            throw new UserAlreadyExistsException('User not found');
        }

        $eloquentModel = new User;
        $eloquentModel->id = $user->getId();
        $eloquentModel->name = $user->getName();
        $eloquentModel->email = $user->getEmail();
        $eloquentModel->password = $user->getPassword();
        $eloquentModel->created_at = $user->getCreatedAt();
        $eloquentModel->updated_at = $user->getUpdatedAt();
        $eloquentModel->save();
    }

    private function mapToEntity(User $eloquentModel): UserEntity
    {
        return UserEntity::create(
            $eloquentModel->id,
            $eloquentModel->name,
            $eloquentModel->email,
            $eloquentModel->password,
            $eloquentModel->created_at,
            $eloquentModel->updated_at
        );
    }
}
