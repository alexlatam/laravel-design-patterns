<?php

namespace Hex\Users\Domain;

use Hex\Users\Domain\Exceptions\UserCreatedAtIsEmptyException;
use Hex\Users\Domain\Exceptions\UserEmailIsEmptyException;
use Hex\Users\Domain\Exceptions\UserNameIsEmptyException;
use Hex\Users\Domain\Exceptions\UserPasswordIsEmptyException;
use Hex\Users\Domain\Exceptions\UserUuidIsEmptyException;
use Hex\Users\Domain\ValueObjects\UserCreatedAt;
use Hex\Users\Domain\ValueObjects\UserEmail;
use Hex\Users\Domain\ValueObjects\UserName;
use Hex\Users\Domain\ValueObjects\UserPassword;
use Hex\Users\Domain\ValueObjects\UserUpdatedAt;
use Hex\Users\Domain\ValueObjects\UserUuid;

final readonly class User
{
    private function __construct(
        private UserUuid $id,
        private UserName $name,
        private UserEmail $email,
        private UserPassword $password,
        private UserCreatedAt $createdAt,
        private UserUpdatedAt $updatedAt
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name->getName();
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * @throws UserUuidIsEmptyException
     * @throws UserNameIsEmptyException
     * @throws UserCreatedAtIsEmptyException
     * @throws UserPasswordIsEmptyException
     * @throws UserEmailIsEmptyException
     */
    public static function create(
        string $id,
        string $name,
        string $email,
        string $password,
        string $createdAt,
        string $updatedAt
    ): self {
        return new self(
            new UserUuid($id),
            new UserName($name),
            new UserEmail($email),
            new UserPassword($password),
            new UserCreatedAt($createdAt),
            new UserUpdatedAt($updatedAt)
        );
    }

}
