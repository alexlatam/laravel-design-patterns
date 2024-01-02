<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'state',
        'score',
        'extra',
        'id_error',
        'auction',
        'assignee',
    ];
}
