<?php

namespace DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Infraestructure\Bus\Event\InMemory;

use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Events\DomainEvent;
use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Events\DomainEventSubscriberInterface;
use DomainEvents\RecordOnAggNamedConstructorAndDispatchOnApplicationService\Domain\Events\EventBusInterface;

class InMemoryEventBus implements EventBusInterface
{
    /**
     * [string => callable[]]
     * [
     *     'UserRegisteredDomainEvent' => [SendWelcomeEmailOnUserRegistered, SendWelcomeEmailOnUserRegistered]
     * ]
     */
    private array $subscriptions = [];

    /**
     * El constructor recibe solo parametros de tipo DomainEventSubscriberInterface.
     * Y luego los convierte en un array.
     * Este array lo enviamos via argument unpacking a la funcion registerSubscribers.
     * Este contructor es inyectado en el contenedor de dependencias.
     * Argument unpacking:
     *      [$subscriber, $subscriber, $subscriber] => $subscriber, $subscriber, $subscriber
     */
    public function __construct(DomainEventSubscriberInterface ...$subscribers)
    {
        $this->registerSubscribers(...$subscribers);
    }

    /**
     * Este metodo es llamado desde los casos de uso para publicar eventos de dominio.
     * Este metodo es el encargado de publicar los eventos de dominio.
     * Este metodo recibe un array de eventos de dominio [DomainEvent, DomainEvent] y los publica.
     */
    public function publish(DomainEvent ...$events): void
    {
        foreach ($events as $event) {
            // Guardamos en un array[subscriptions] los suscriptores que estan escuchando el evento de dominio.
            $subscribers = $this->subscriptions[$event->eventName()];

            // En caso de existir suscriptores para el evento de dominio, los ejecutamos.
            if ($subscribers) {
                // Recorremos todos los suscriptores del evento de dominio.
                foreach ($subscribers as $subscriber) {
                    // Ejecutamos el suscriptor. Le pasamos el evento al cual esta suscrito.
                    $subscriber($event);
                }
            }
        }
    }

    /**
     * Este metodo es el encargado de registrar en este event bus los suscriptores con sus respectivos eventos de dominio.
     */
    private function registerSubscribers(DomainEventSubscriberInterface ...$subscribers): void
    {
        // Recorro todos los suscriptores de este evento de dominio.
        foreach ($subscribers as $subscriber) {
            // Obtengo todos los eventos a los cuales esta suscrito el suscriptor.
            $eventsThatItsSubscriber = $subscriber->subscribedTo();

            //* Recorro todos los eventos de dominio a los cuales esta suscrito el suscriptor.
            foreach ($eventsThatItsSubscriber as $event) {
                // Llamo al metodo subscribe para registrar el suscriptor en el evento de dominio.
                $this->subscribe($event->eventName(), $subscriber);
            }
        }
    }

    /**
     * Metodo que registra un suscriptor a un evento de dominio.
     */
    private function subscribe(string $eventName, DomainEventSubscriberInterface $subscriber): void
    {
        // Obtenemos los suscriptores actuales del evento de dominio.
        $currentSubscriptions = $this->subscriptions[$eventName];

        if ($currentSubscriptions) {
            $currentSubscriptions[] = $subscriber;
        } else {
            $this->subscriptions[$eventName] = $subscriber;
        }
    }
}
