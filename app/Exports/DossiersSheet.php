<?php

namespace App\Exports;

use App\Models\Dossier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class DossiersSheet implements FromCollection, WithHeadings, WithTitle
{
    public function collection()
    {
        return Dossier::with(['juge', 'greffier'])->get()->map(fn($dossier) => [
            'Numéro' => $dossier->numero_dossier,
            'Statut' => $dossier->statut,
            'Juge' => optional($dossier->juge)->name ?? 'N/A',
            'Greffier' => optional($dossier->greffier)->name ?? 'N/A',
        ]);
    }

    public function headings(): array
    {
        return ['Numéro', 'Statut', 'Juge', 'Greffier'];
    }

    public function title(): string
    {
        return 'Dossiers';
    }
}
