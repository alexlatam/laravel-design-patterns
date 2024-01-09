<?php

namespace App\Models\EventSourcing\Async;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Citizen extends Model
{
    use HasFactory;

    protected $table = 'citizens_async';

    public $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function uuid(string $uuid): self
    {
        return static::where('uuid', $uuid)->first();
    }
}
