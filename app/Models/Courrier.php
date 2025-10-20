<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courrier extends Model
{
    use HasFactory;
      //  protected $primaryKey = 'id_courrier';

    protected $fillable = [

        'reference',
        'type',
        'date_courrier',
        'expediteur',
        'destinataire',
        'dossier_id',
        'status', // en cours, traité, archivé
        'fichier', // chemin du fichier uploadé
    ];

    // Relation avec le dossier
    public function dossier()
    {
        return $this->belongsTo(Dossier::class, 'dossier_id');
    }

    // Relation avec l’utilisateur qui a créé le courrier
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
