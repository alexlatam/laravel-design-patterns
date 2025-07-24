<?php

namespace DomainEvents\Shared\SendMails\Application\SendUserProfileUpdatedEmail;

use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Events\DomainEventSubscriberInterface;
use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Events\UserRegisteredDomainEvent;
use DomainEvents\Shared\SendMails\Application\SendWelcomeEmail\WelcomeEmailSenderUseCase;

/**
 * Clase que se encarga de escuchar el evento de dominio: Usuario Registrado [UserRegisteredDomainEvent]
 * Esta clase es un DomainEventSubscriber, es decir, se suscribe a eventos de dominio [Suscriptor de Eventos de Dominio]
 * Es una clase que reacciona a eventos de dominio a los cuales esta suscrito.
 */
readonly class SendEmailOnUserEmailUpdated implements DomainEventSubscriberInterface
{
    // Inyectamos el caso de uso que se encarga de enviar el email de bienvenida
    public function __construct(private WelcomeEmailSenderUseCase $sender)
    {}

    /**
     * Metodo que se ejecuta cuando se dispara el evento de dominio: Usuario Registrado [UserRegisteredDomainEvent]
     * Evento al cual estamos suscritos
     * Este metodo es una accion derivada de un evento de dominio, por lo tano no devuleve nada [void].
     * -- No hay quien reciba el resultado de esta accion.
     */
    public function __invoke(UserRegisteredDomainEvent $event): void
    {
        $this->sender->send($event->toPrimitives());
    }

    /**
     * Aqui indicamos a cuales eventos de dominio nos vamos a suscribir.
     * En este caso nos suscribimos al evento de dominio: Usuario Registrado [UserRegisteredDomainEvent]
     */
    public function subscribedTo(): array
    {
        return [
            UserRegisteredDomainEvent::class,
        ];
    }
}
