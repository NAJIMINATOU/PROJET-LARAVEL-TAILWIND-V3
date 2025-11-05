<?php

namespace App\Exports;

use App\Models\Audience;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class AudiencesSheet implements FromCollection, WithHeadings, WithTitle
{
    public function collection()
    {
        return Audience::with('juge')->get()->map(fn($audience) => [
            'ID' => $audience->id,
            'Date' => $audience->date_audience->format('d/m/Y'),
            'Juge' => optional($audience->juge)->name ?? 'N/A',
        ]);
    }

    public function headings(): array
    {
        return ['ID', 'Date', 'Juge'];
    }

    public function title(): string
    {
        return 'Audiences';
    }
}
