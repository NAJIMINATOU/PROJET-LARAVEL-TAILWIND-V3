<?php
namespace App\Http\Controllers;

use App\Models\Courrier;
use App\Models\Dossier;
use Illuminate\Http\Request;

class CourrierController extends Controller
{
   
public function create()
{
    $dossiers = Dossier::all();
    return view('courriers.create', compact('dossiers'));
}


     public function index(Request $request)
    {
        $query = Courrier::query();

        if ($search = $request->search) {
            $query->where('reference', 'like', "%$search%")
                  ->orWhere('expediteur', 'like', "%$search%")
                  ->orWhere('destinataire', 'like', "%$search%");
        }

        $courriers = $query->latest()->paginate(10);
        return view('courriers.index', compact('courriers'));
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'reference' => 'required|unique:courriers,reference',
        'type' => 'required|in:entrant,sortant',
        'date_courrier' => 'required|date',
        'expediteur' => 'required|string|max:255',
        'destinataire' => 'required|string|max:255',
        'id_dossier' => 'nullable|exists:dossiers,id',
        'fichier' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:2048',
    ]);

    // Upload fichier s’il existe
    if ($request->hasFile('fichier')) {
        $validated['fichier'] = $request->file('fichier')->store('courriers', 'public');
    }
        $user = auth()->user();

 // Ajout explicite du greffier connecté
    $validated['greffier_id'] = $user->id;

    Courrier::create($validated);

    return redirect()->route('courriers.index')->with('success', 'Courrier ajouté avec succès.');
}

public function edit(Courrier $courrier)
{
   $dossiers = Dossier::all();
    return view('courriers.edit', compact('courrier', 'dossiers'));
}


    public function update(Request $request, $id)
{
    $courrier = Courrier::findOrFail($id);

    $validated = $request->validate([
        'type' => 'required|in:entrant,sortant',
        'date_courrier' => 'required|date',
        'expediteur' => 'required|string|max:255',
        'destinataire' => 'required|string|max:255',
        'dossier_id' => 'nullable|exists:dossiers,id',
        'status' => 'required|in:en_cours,traite,archive',
        'piece_jointe' => 'nullable|file|mimes:pdf,jpg,png,doc,docx',
    ]);

    // Upload pièce jointe si présente
    if ($request->hasFile('piece_jointe')) {
        $filePath = $request->file('piece_jointe')->store('courriers', 'public');
        $validated['piece_jointe'] = $filePath;
    }

    $courrier->update($validated);

    return redirect()->route('courriers.index')->with('success', 'Courrier mis à jour avec succès !');
}
public function show(Courrier $courrier)
{
    return view('courriers.show', compact('courrier'));
}
    public function destroy(Courrier $courrier)
    {
        $courrier->delete();
        return redirect()->route('courriers.index')->with('success','Courrier supprimé');
    }
}
