<?php

namespace App\Projectors\Async;

use App\Models\EventSourcing\Async\TransactionCount;
use App\StorableEvents\EventSourcing\Async\ItemsDelivered;
use App\StorableEvents\EventSourcing\Async\TransactionCountCreated;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class TransactionsCountProjector extends Projector
{
    public function onTransactionCountCreated(TransactionCountCreated $event): void
    {
        if(config('transactions.run_transactions_count_projector')) {
            TransactionCount::create([
                'uuid' => $event->aggregateRootUuid(),
                'user_id' => $event->userId,
            ]);
        }
    }

    public function onItemsDelivered(ItemsDelivered $event): void
    {
        if(config('transactions.run_transactions_count_projector')) {
            TransactionCount::uuid($event->aggregateRootUuid())->incrementTotal();
        }
    }

    public function resetState(): void
    {
        TransactionCount::truncate();
    }
}
