<?php

namespace App\Reactors\EventSourcing\Async;

use App\Models\EventSourcing\Async\Citizen;
use App\Models\User;
use App\Notifications\EventSourcing\Async\BigAmountItemsDeliveredNotification;
use App\StorableEvents\EventSourcing\Async\ItemsDelivered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\EventSourcing\EventHandlers\Reactors\Reactor;

class BigAmountItemsDeliveredReactor extends Reactor implements ShouldQueue
{
    public function __invoke(ItemsDelivered $event): void
    {
        if ($event->amount < 30) {
            return;
        }

        $citizen = Citizen::uuid($event->aggregateRootUuid());

        // Send notification to the user
        (User::make([
            'name' => "RRHH",
            'email' => "administrator@mail.com",
        ]))->notify(new BigAmountItemsDeliveredNotification($citizen, $event->amount));
    }
}
