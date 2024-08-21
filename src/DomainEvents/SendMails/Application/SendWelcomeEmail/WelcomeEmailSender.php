<?php

namespace DomainEvents\SendMails\Application\SendWelcomeEmail;

use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Contracts\UuidGenerator;
use DomainEvents\SendMails\Domain\Contracts\EmailSenderInterface;
use DomainEvents\SendMails\Domain\WelcomeEmail;

/**
 * Caso de uso de enviar mail de bienvenida, a partir de un usuario registrado.
 * Este caso de uso es un event subscriber, ya que se suscribe a los eventos de dominio que se generan en el email de bienvenida.
 */
final readonly class WelcomeEmailSender
{
    public function __construct(
        private EmailSenderInterface $emailSender,
        private EventBus $eventBus,
        private UuidGenerator $uuid,
    ) {}

    public function send(array $data): void
    {
        /**
         * Creamos el email de bienvenida.
         * Entidad de Dominio que contiene todas las validaciones de un email de bienvenida
         */
        $email = WelcomeEmail::send(
            id: $this->uuid->generate(),
            user_id: $data['id'],
            name: $data['name'],
            email: $data['email'],
        );

        /**
         * Enviamos el email de bienvenida, usando el adaptador de infraestructura [EmailSender]
         */
        $this->emailSender->send($email);

        /**
         * Despachamos [disparamos, publicamos] los eventos de dominio que se han generado en el email de bienvenida
         * Los eventos que se han generado en el email de bienvenida son:
         * - Email de Bienvenida Enviado [WelcomeEmailSentDomainEvent]
         */
        $this->eventBus->publish($email->pullDomainEvents());
    }
}
