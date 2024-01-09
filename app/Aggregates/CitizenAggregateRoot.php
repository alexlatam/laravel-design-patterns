<?php

namespace App\Aggregates;

use App\Exceptions\EventSourcing\Async\CouldNotDeliveryItems;
use App\StorableEvents\EventSourcing\Async\CitizenCreated;
use App\StorableEvents\EventSourcing\Async\CitizenLimitHit;
use App\StorableEvents\EventSourcing\Async\ItemsDelivered;
use App\StorableEvents\EventSourcing\Async\TransactionCountCreated;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class CitizenAggregateRoot extends AggregateRoot
{
    protected int $total = 0;

    protected int $limitItems = 100;

    public function createCitizen(string $user_id): self
    {
        $this->recordThat(new CitizenCreated($user_id));
        return $this;
    }

    public function createTransactionCount(string $userId): self
    {
        $this->recordThat(new TransactionCountCreated($userId));

        return $this;
    }

    /**
     * @throws CouldNotDeliveryItems
     */
    public function deliveryItems(int $amount): self
    {
        if ($this->exceededDeliveredItems($amount)) {
            // Registramos el evento de que se excedio el limite en base de datos
            $this->recordThat(new CitizenLimitHit())->persist();

            throw CouldNotDeliveryItems::limitExceeded($amount);
        }

        $this->recordThat(new ItemsDelivered($amount));

        return $this;
    }

    /**
     * Este metodo se ejecuta cuando se lanza el evento CitizenCreated
     * Para funcionar, este metodo debe empezar con el nombre "apply". Esto lo pide el paquete spatie/laravel-event-sourcing
     */
    public function applyDeliveryItems(ItemsDelivered $event): void
    {
        $this->total += $event->amount;
    }

    private function exceededDeliveredItems(int $amount): bool
    {
        return $this->total + $amount > $this->limitItems;
    }
}
