<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturedProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "stock",
        "available",
    ];

    protected $casts = [
        "stock" => "integer",
        "available" => "boolean",
    ];
}
