<?php

namespace App\Http\Controllers;

use App\Models\Dossier;
use App\Models\User;
use Illuminate\Http\Request;

class DossierController extends Controller
{
    /**
     * Liste des dossiers avec recherche.
     */
    public function index(Request $request)
    {
        $query = Dossier::query();

        // 🔍 Recherche
        if ($request->filled('numero_dossier')) {
            $query->where('numero_dossier', 'like', "%{$request->numero_dossier}%");
        }
        if ($request->filled('type_affaire')) {
            $query->where('type_affaire', 'like', "%{$request->type_affaire}%");
        }
        if ($request->filled('date_depot')) {
            $query->whereDate('date_depot', $request->date_depot);
        }

        $dossiers = $query->orderBy('date_depot', 'desc')->paginate(10);

        return view('dossiers.index', compact('dossiers'));
    }

    /**
     * Afficher le formulaire de création.
     */
    public function create()
    {
        // 🧑‍⚖️ Récupérer la liste des juges disponibles
        $juges = User::where('role', 'juge')->get();

        return view('dossiers.create', compact('juges'));
    }

    /**
     * Enregistrer un nouveau dossier.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero_dossier' => 'required|unique:dossiers,numero_dossier',
            'type_affaire' => 'required|string|max:255',
            'date_depot' => 'required|date',
            'statut' => 'required|in:en cours,clos,en appel',
            'description' => 'nullable|string',
            'juge_id' => 'nullable|exists:users,id',
        ]);

        $user = auth()->user();

        // 🧠 Associer automatiquement le créateur du dossier
        $validated['user_id'] = $user->id;

        // 🧾 Si c’est un greffier, on stocke aussi son ID
        if ($user->role === 'greffier') {
            $validated['greffier_id'] = $user->id;
        }

        Dossier::create($validated);

        return redirect()->route('dossiers.index')
                         ->with('success', '✅ Dossier ajouté avec succès.');
    }

    /**
     * Afficher un dossier.
     */
    public function show(Dossier $dossier)
    {
        return view('dossiers.show', compact('dossier'));
    }

    /**
     * Modifier un dossier.
     */
    public function edit(Dossier $dossier)
    {
        $juges = User::where('role', 'juge')->get();

        return view('dossiers.edit', compact('dossier', 'juges'));
    }

    /**
     * Mettre à jour un dossier.
     */
    public function update(Request $request, Dossier $dossier)
    {
        $validated = $request->validate([
            'numero_dossier' => 'required|unique:dossiers,numero_dossier,' . $dossier->id,
            'type_affaire' => 'required|string|max:255',
            'date_depot' => 'required|date',
            'statut' => 'required|in:en cours,clos,en appel',
            'description' => 'nullable|string',
            'juge_id' => 'nullable|exists:users,id',
        ]);

        $dossier->update($validated);

        return redirect()->route('dossiers.index')
                         ->with('success', '✅ Dossier mis à jour avec succès.');
    }

    /**
     * Supprimer un dossier.
     */
    public function destroy(Dossier $dossier)
    {
        $dossier->delete();

        return redirect()->route('dossiers.index')
                         ->with('success', '🗑️ Dossier supprimé avec succès.');
    }
}
