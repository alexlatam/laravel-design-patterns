<?php

namespace DomainEvents\SendMails\Domain\Contracts;

use DomainEvents\SendMails\Domain\WelcomeEmail;

interface EmailSenderInterface
{
    public function send(WelcomeEmail $mail): void;
}
