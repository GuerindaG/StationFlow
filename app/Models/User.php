<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable;

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isGerant()
    {
        return $this->role === 'gerant';
    }

    public function station()
    {
        return $this->hasOne(Station::class, 'gerant_id');
    }
}
