<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Casts\Email;
use App\Casts\Phone;
use App\Casts\Title;
use App\Casts\Url;
use App\ValueObjects\Concretes\FullName;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'url',
        'phone',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'  => 'hashed',
        'name'      => Title::class,
        'last_name' => Title::class,
        'email'     => Email::class,
        'url'       => Url::class,
        'phone'     => Phone::class,
    ];

    public function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => FullName::from(
                $this->name->value() . ' ' . $this->last_name->value()
            )
        );
    }
}
