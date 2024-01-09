<?php

namespace App\Models\EventSourcing\Async;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionPerMonth extends Model
{
    use HasFactory;

    protected $table = 'transaction_per_months_event_sourcing';

    protected $guarded = [];

    public static function date(int $month, int $year): self
    {
        return static::where('transaction_month', $month)
            ->where('transaction_year', $year)
            ->firstOrCreate([
                'transaction_month' => $month,
                'transaction_year' => $year,
            ], [
                'transaction_month' => $month,
                'transaction_year' => $year,
                'total' => 0,
            ]);
    }
}
