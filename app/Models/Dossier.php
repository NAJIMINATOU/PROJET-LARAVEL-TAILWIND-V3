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
        'juge_id',
        'user_id',
        'greffier_id', // <= IMPORTANT
    ];
   public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // 🔹 Chaque dossier appartient à un juge
    public function juge()
    {
        return $this->belongsTo(User::class, 'juge_id');
    }
 public function greffier()
    {
        return $this->belongsTo(User::class, 'greffier_id');
    }
    public function audiences()
    {
        return $this->hasMany(Audience::class);
    }

    public function parties()
    {
        return $this->hasMany(Partie::class);
    }

    public function courriers()
    {
        return $this->hasMany(Courrier::class);
    }
}
