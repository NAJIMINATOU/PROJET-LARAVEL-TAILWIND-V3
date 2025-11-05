<?php

namespace App\Exports;

use App\Models\Courrier;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class CourriersSheet implements FromCollection, WithHeadings, WithTitle
{
    public function collection()
    {
        return Courrier::with('greffier')->get()->map(fn($courrier) => [
            'ID' => $courrier->id,
            'Type' => ucfirst($courrier->type),
            'Objet' => $courrier->objet,
            'Greffier' => optional($courrier->greffier)->name ?? 'N/A',
        ]);
    }

    public function headings(): array
    {
        return ['ID', 'Type', 'Objet', 'Greffier'];
    }

    public function title(): string
    {
        return 'Courriers';
    }
}

