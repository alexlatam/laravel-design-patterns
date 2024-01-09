<?php

namespace App\Projectors\Async;

use App\Models\EventSourcing\Async\TransactionPerMonth;
use App\StorableEvents\EventSourcing\Async\ItemsDelivered;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class TransactionPerMonthProjector extends Projector
{
    public function onDeliveredItems(ItemsDelivered $event): void
    {
        if(config('transactions.run_transaction_per_month_projector')) {
            $month = $event->createdAt()->month;
            $year = $event->createdAt()->year;
            $transaction = TransactionPerMonth::date($month, $year);
            $transaction->total += 1;

            $transaction->save();
        }
    }

    public function resetState(): void
    {
        TransactionPerMonth::truncate();
    }
}
