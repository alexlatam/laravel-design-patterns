<?php

namespace App\Models;

use App\Casts\File;
use App\Casts\Money;
use App\Casts\Title;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "price",
        "image",
        "status",
    ];

    protected $cast = [
        "title" => Title::class,
        "price" => Money::class,
        "image" => File::class,
    ];
}
