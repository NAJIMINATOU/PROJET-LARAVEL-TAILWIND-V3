<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audience extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_audience',
        'salle',
        'dossier_id',
        'user_id',
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
}
