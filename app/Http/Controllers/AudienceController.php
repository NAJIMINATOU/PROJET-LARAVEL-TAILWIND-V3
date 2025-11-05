<?php

namespace App\Http\Controllers;

use App\Models\Audience;
use App\Models\Dossier;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AudiencesExport;
use Illuminate\Http\Request;

class AudienceController extends Controller
{


// Export PDF
public function exportPdf()
{
    $audiences = Audience::with(['dossier','user'])->get();
    $pdf = Pdf::loadView('audiences.pdf', compact('audiences'));
    return $pdf->download('audiences.pdf');
}

// Export Excel
public function exportExcel()
{
    return Excel::download(new AudiencesExport, 'audiences.xlsx');
}
    public function calendar()
{
    $audiences = \App\Models\Audience::with(['user', 'dossier'])->get();

    // Préparer les événements pour FullCalendar
    $events = $audiences->map(function ($a) {
        return [
            'title' => 'Dossier ' . ($a->dossier->numero_dossier ?? '') . ' - ' . ($a->user->name ?? 'Juge ?'),
            'start' => $a->date_audience,
            'url' => route('audiences.edit', $a->id),
        ];
    });

    return view('audiences.calendar', ['events' => $events]);
}

    public function index()
    {
        $audiences = Audience::with(['dossier', 'user'])->latest()->paginate(10);
        return view('audiences.index', compact('audiences'));
    }

    public function create()
    {
        $dossiers = Dossier::all();
        $juges = User::where('role', 'juge')->get();
        return view('audiences.create', compact('dossiers', 'juges'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date_audience' => 'required|date',
            'salle' => 'required|string|max:255',
            'dossier_id' => 'required|exists:dossiers,id',
            'user_id' => 'required|exists:users,id',
        ]);
            $user = auth()->user();

 // Ajoute automatiquement le greffier connecté
    $validated['greffier_id'] = $user->id;
        Audience::create($validated);

        return redirect()->route('audiences.index')->with('success', '✅ Audience ajoutée avec succès.');
    }
public function show($id)
{
    $audience = \App\Models\Audience::with(['dossier', 'user'])->findOrFail($id);
    return view('audiences.show', compact('audience'));
}
public function edit(Audience $audience)
{
    $dossiers = \App\Models\Dossier::all();
    $juges = \App\Models\User::where('role', 'juge')->get();

    return view('audiences.edit', compact('audience', 'dossiers', 'juges'));
}
public function update(Request $request, Audience $audience)
{
    $validated = $request->validate([
        'date_audience' => 'required|date',
        'salle'        => 'required|string|max:255',
        'dossier_id'   => 'required|exists:dossiers,id',
        'user_id'      => 'required|exists:users,id',
    ]);

    $audience->update($validated);

    return redirect()->route('audiences.index')
                     ->with('success', '✅ Audience mise à jour avec succès.');
}

    public function destroy(Audience $audience)
    {
        $audience->delete();
        return redirect()->route('audiences.index')->with('success', '🗑️ Audience supprimée avec succès.');
    }
}
