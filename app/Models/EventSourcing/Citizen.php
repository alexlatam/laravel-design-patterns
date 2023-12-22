<?php

namespace App\Models\EventSourcing;

use App\Models\User;
use App\StorableEvents\EventSourcing\CitizenCreated;
use App\StorableEvents\EventSourcing\ItemsDelivered;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Citizen extends Model
{
    use HasFactory;

    protected $table = 'citizens_event_sourcing';

    protected $fillable = [
        'uuid',
        'community',
        'user_id',
        'total',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the citizen by uuid.
     */
    public static function uuid(string $uuid): self
    {
        return self::where('uuid', $uuid)->first();
    }

    public static function createWithAttributes(array $attributes): self
    {
        $attributes['uuid'] = Str::uuid()->toString();

        event(new CitizenCreated($attributes['uuid'], $attributes));

        return self::uuid($attributes['uuid']);
    }

    public function deliveryItems(int $amount): void
    {
        event(new ItemsDelivered($this->uuid, $amount));
    }
}
