<?php

namespace App\Projectors\Sync;

use App\Models\EventSourcing\Sync\Citizen;
use App\StorableEvents\EventSourcing\Sync\CitizenCreated;
use App\StorableEvents\EventSourcing\Sync\ItemsDelivered;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class CitizenProjector extends Projector
{
    /**
     * Metodo que se ejecuta cuando el evento CitizenCreated es lanzado
     * Es un Listener
     */
    public function onCitizenCreated(CitizenCreated $event): void
    {
        Citizen::create($event->attributes);
    }

    public function onItemsDelivered(ItemsDelivered $event): void
    {
        $citizen = Citizen::uuid($event->citizenUuid);

        $citizen->total += $event->amount;

        $citizen->save();
    }

    /**
     * Metodo que permite resetear el estado del proyector [la tabla citizens_event_sourcing]
     * Se ejcutara cada vez que se ejecute el comando php artisan event-sourcing:replay
     * Si el metodo no existe, se duplicaran los registros en la tabla cada vez que se ejecute el comando
     */
    public function resetState(): void
    {
        Citizen::truncate();
    }
}
