<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DashboardExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new PerformanceJugesSheet(),
            new DossiersSheet(),
            new AudiencesSheet(),
            new CourriersSheet(),
        ];
    }
}
