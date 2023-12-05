<?php

namespace App\Models;

use App\Casts\File;
use App\Casts\Money;
use App\Casts\Title;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "description",
        "price",
        "image",
        "status",
    ];

    protected $cast = [
        "title" => Title::class,
        "price" => Money::class,
        "image" => File::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
