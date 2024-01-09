<?php

namespace App\Projectors\Sync;

use App\Models\EventSourcing\Sync\Citizen;
use App\Models\EventSourcing\Sync\TransactionCount;
use App\StorableEvents\EventSourcing\Sync\ItemsDelivered;
use App\StorableEvents\EventSourcing\Sync\TransactionCountCreated;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class TransactionCountProjector extends Projector
{
    public function onTransactionCountCreated(TransactionCountCreated $event): void
    {
        if(config("transactions.run_transactions_count_projector")) {
            TransactionCount::create($event->attributes);
        }
    }

    public function onItemsDelivered(ItemsDelivered $event): void
    {
        if(config("transactions.run_transactions_count_projector")) {
            $citizen = Citizen::uuid($event->citizenUuid);
            TransactionCount::incrementTotal($citizen);
        }
    }
}
