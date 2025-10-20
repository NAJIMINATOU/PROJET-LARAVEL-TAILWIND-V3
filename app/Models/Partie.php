<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partie extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'type',
        'dossier_id',
    ];

    // 🔹 Une partie appartient à un dossier
    public function dossier()
    {
        return $this->belongsTo(Dossier::class);
    }
}
