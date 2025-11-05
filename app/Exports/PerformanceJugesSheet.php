<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PerformanceJugesSheet implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::where('role', 'juge')
            ->withCount([
                'dossiers as dossiers_en_cours_count' => function($q) {
                    $q->where('statut', 'en cours');
                },
                'dossiers as dossiers_clus_count' => function($q) {
                    $q->where('statut', 'clos');
                },
                'dossiers as dossiers_en_appel_count' => function($q) {
                    $q->where('statut', 'en appel');
                },
            ])
            ->get()
            ->map(function($juge) {
                return [
                    'Nom' => $juge->name,
                    'Dossiers en cours' => $juge->dossiers_en_cours_count,
                    'Dossiers clos' => $juge->dossiers_clus_count,
                    'Dossiers en appel' => $juge->dossiers_en_appel_count,
                    'Total dossiers' => $juge->dossiers_en_cours_count + $juge->dossiers_clus_count + $juge->dossiers_en_appel_count,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nom',
            'Dossiers en cours',
            'Dossiers clos',
            'Dossiers en appel',
            'Total dossiers',
        ];
    }
}
