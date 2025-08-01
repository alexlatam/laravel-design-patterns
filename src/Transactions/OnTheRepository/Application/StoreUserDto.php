<?php

namespace Transactions\OnTheRepository\Application;

final readonly class StoreUserDto
{
    public function __construct(
        public string $id,
        public string $firstname,
        public string $lastname,
        public string $email
    ) {
    }
}
