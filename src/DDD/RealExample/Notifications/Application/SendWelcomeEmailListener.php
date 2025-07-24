<?php

namespace DDD\RealExample\Notifications\Application;

use DDD\RealExample\Notifications\Domain\MailerInterface;
use DDD\RealExample\User\Domain\UserRegistered;

class SendWelcomeEmailListener
{
    public function __construct(private readonly MailerInterface $mailer)
    {
    }

    public function handle(UserRegistered $event): void
    {
        $email = $event->email();
        $occurredOn = $event->occurredOn();

        // Lógica para enviar el email de bienvenida
        $this->mailer->sendWelcomeEmail($email, [
            'occurredOn' => $occurredOn,
            // Otros datos necesarios
        ]);
    }
}
