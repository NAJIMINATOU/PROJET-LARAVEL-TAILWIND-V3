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
public function dossiers()
{
    return $this->hasMany(Dossier::class, 'juge_id');
}
    // 🔹 Un juge peut avoir plusieurs dossiers
  public function dossiersEnCours()
{
    return $this->hasMany(Dossier::class, 'juge_id')->where('statut', 'en cours');
}

public function dossiersClos()
{
    return $this->hasMany(Dossier::class, 'juge_id')->where('statut', 'clos');
}

public function dossiersEnAppel()
{
    return $this->hasMany(Dossier::class, 'juge_id')->where('statut', 'en appel');
}

    // 🔹 Un juge peut diriger plusieurs audiences
    public function audiences()
    {
        return $this->hasMany(Audience::class, 'juge_id');
    }
}
