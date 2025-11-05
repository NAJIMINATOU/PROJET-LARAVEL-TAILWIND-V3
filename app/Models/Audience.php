<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audience extends Model
{
    use HasFactory;

    protected $casts= [
    'date_audience' => 'datetime',
        'salle',
        'dossier_id',
        'user_id',
    ];
    protected $fillable = [
    'date_audience',
    'salle',
    'dossier_id',
    'user_id',
    'juge_id', // si tu as ce champ aussi
            'greffier_id', // <= IMPORTANT

];

    // 🔹 Relation : une audience appartient à un dossier
    public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }

    // 🔹 Relation : une audience appartient à un juge (utilisateur)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    
     public function juge()
    {
        return $this->belongsTo(User::class, 'juge_id');
    }
}
