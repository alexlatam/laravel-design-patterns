<?php

namespace App\Models\EventSourcing\Async;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionCount extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'transaction_counts_async';

    public static function uuid(string $uuid): self
    {
        return static::where('uuid', $uuid)->first();
    }

    public function incrementTotal(): void
    {
        $this->total++;
        $this->save();
    }
}
