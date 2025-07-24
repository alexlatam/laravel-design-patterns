<?php

namespace Hex\Backoffice\Users\Domain;

use Hex\Backoffice\Users\Domain\Exceptions\UserCreatedAtIsEmptyException;
use Hex\Backoffice\Users\Domain\Exceptions\UserEmailIsEmptyException;
use Hex\Backoffice\Users\Domain\Exceptions\UserNameIsEmptyException;
use Hex\Backoffice\Users\Domain\Exceptions\UserPasswordIsEmptyException;
use Hex\Backoffice\Users\Domain\Exceptions\UserUuidIsEmptyException;
use Hex\Backoffice\Users\Domain\ValueObjects\UserCreatedAt;
use Hex\Backoffice\Users\Domain\ValueObjects\UserEmail;
use Hex\Backoffice\Users\Domain\ValueObjects\UserName;
use Hex\Backoffice\Users\Domain\ValueObjects\UserPassword;
use Hex\Backoffice\Users\Domain\ValueObjects\UserUpdatedAt;
use Hex\Backoffice\Users\Domain\ValueObjects\UserUuid;

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
        // throw event UserCreated
    }

    /**
     * This method is useful to rebuild a User instance from the repository. To avoid dispatching unwanted events.
     * @throws UserEmailIsEmptyException
     * @throws UserPasswordIsEmptyException
     * @throws UserCreatedAtIsEmptyException
     * @throws UserUuidIsEmptyException
     * @throws UserNameIsEmptyException
     */
    public static function build(
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

}
