<?php

namespace App\Models\EventSourcing\Sync;

use App\StorableEvents\EventSourcing\Sync\TransactionCountCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TransactionCount extends Model
{
    use HasFactory;

    public $guarded = [];

    public static function createWithAttributes(array $attributes): void
    {
        $attributes['uuid'] = Str::uuid()->toString();

        event(new TransactionCountCreated($attributes['uuid'], $attributes));
    }

    public static function incrementTotal(Citizen $citizen): void
    {
        $transactionCounter = self::firstOrCreate(['user_id' => $citizen->user_id]);

        $transactionCounter->total += 1;

        $transactionCounter->save();
    }
}
