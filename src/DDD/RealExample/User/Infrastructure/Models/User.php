<?php

namespace DDD\RealExample\User\Infrastructure\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['id', 'name', 'email', 'password'];
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;
}
