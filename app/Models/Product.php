<?php

namespace App\Models;

use App\Casts\File;
use App\Casts\Money;
use App\Casts\Title;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Collection;

final class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "description",
        "price",
        "image",
        "stock",
        "available",
        "status",
    ];

    protected array $cast = [
        "title" => Title::class,
        "price" => Money::class,
        "image" => File::class,
        "stock" => "integer",
        "available" => "boolean",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function getAll(): Collection
    {
        return self::all();
    }
}
