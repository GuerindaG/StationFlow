<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'prenom',
        'email',
        'password',
        'naissance',
        'telephone',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    use Notifiable;

    public function station()
    {
        return $this->hasOne(Station::class, 'gerant_id');
    }

    public const ROLE_ADMIN = 'admin';
    public const ROLE_GESTIONNAIRE = 'gestionnaire';

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isGestionnaire()
    {
        return $this->role === self::ROLE_GESTIONNAIRE;
    }
}
