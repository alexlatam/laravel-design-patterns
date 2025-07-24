<?php

namespace DDD\RealExample\Notifications\Domain;

interface MailerInterface
{
    public function sendWelcomeEmail(string $email, array $data): void;
}
