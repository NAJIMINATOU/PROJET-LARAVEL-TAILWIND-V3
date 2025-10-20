<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dossier extends Model
{
    use HasFactory;

   protected $fillable = [
    'numero_dossier',
    'type_affaire',
    'date_depot',
    'statut',
    'description',
    'user_id',
];


    // 🔹 Chaque dossier appartient à un utilisateur
    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // 🔹 Un dossier peut avoir plusieurs audiences
    public function audiences()
    {
        return $this->hasMany(Audience::class);
    }

    // 🔹 Un dossier peut avoir plusieurs parties
    public function parties()
    {
        return $this->hasMany(Partie::class);
    }

    // 🔹 Un dossier peut avoir plusieurs courriers
    public function courriers()
    {
        return $this->hasMany(Courrier::class);
    }
}
