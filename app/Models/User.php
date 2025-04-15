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

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // Vérifier si l'utilisateur a une permission
    public function hasPermission($permission)
    {
        return $this->role->permissions->contains('name', $permission);
    }
}
