<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // 🔹 Un utilisateur peut créer plusieurs dossiers
    public function dossiers()
    {
        return $this->hasMany(Dossier::class);
    }

    // 🔹 Un utilisateur (juge) peut diriger plusieurs audiences
    public function audiences()
    {
        return $this->hasMany(Audience::class);
    }
}
