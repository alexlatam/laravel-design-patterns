<?php

namespace DomainEvents\Shared\SendMails\Domain\Contracts;

use DomainEvents\Shared\SendMails\Domain\WelcomeEmail;

interface EmailSenderInterface
{
    public function send(WelcomeEmail $mail): void;
}
