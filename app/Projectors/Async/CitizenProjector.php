<?php

namespace App\Projectors\Async;

use App\Models\EventSourcing\Async\Citizen;
use App\StorableEvents\EventSourcing\Async\CitizenCreated;
use App\StorableEvents\EventSourcing\Async\ItemsDelivered;
use Faker\Provider\es_VE\Address;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class CitizenProjector extends Projector
{
    public function onCitizenCreated(CitizenCreated $event): void
    {
        Citizen::create([
            'uuid' => $event->aggregateRootUuid(),
            'user_id' => $event->userId,
            'community' => Address::community(),
        ]);
    }

    public function onItemsDelivered(ItemsDelivered $event): void
    {
        $citizen = Citizen::uuid($event->aggregateRootUuid());

        $citizen->total += $event->amount;

        $citizen->save();
    }

    public function resetState(): void
    {
        Citizen::truncate();
    }
}
