<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dossier;
use App\Models\Audience;
use App\Models\Courrier;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\DashboardExport;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    /**
     * Affiche le dashboard selon le rôle de l'utilisateur connecté
     */
   public function index()
{
    $user = auth()->user();

    if ($user->role === 'admin') {
        // Performance des juges (compte dossiers par statut)
        $performanceJuges = User::where('role', 'juge')
            ->withCount([
                'dossiers as dossiers_en_cours_count' => fn($q) => $q->where('statut', 'en cours'),
                'dossiers as dossiers_clus_count' => fn($q) => $q->where('statut', 'clos'),
                'dossiers as dossiers_en_appel_count' => fn($q) => $q->where('statut', 'en appel'),
            ])
            ->get();

        $stats = [
            'dossiers_total' => Dossier::count(),
            'dossiers_en_cours' => Dossier::where('statut', 'en cours')->count(),
            'dossiers_clus' => Dossier::where('statut', 'clos')->count(),
            'dossiers_en_appel' => Dossier::where('statut', 'en appel')->count(),
            'audiences_total' => Audience::count(),
            'courriers_total' => Courrier::count(),
            'courriers_entrants' => Courrier::where('type', 'entrant')->count(),
            'courriers_sortants' => Courrier::where('type', 'sortant')->count(),
        ];

        return view('dashboards.admin', compact('stats', 'performanceJuges'));
    }

    if ($user->role === 'juge') {
        $mesDossiers = Dossier::where('juge_id', $user->id)
                        ->orderBy('date_depot', 'desc')
                        ->take(5)
                        ->get();

        $mesAudiences = Audience::where('user_id', $user->id)
                        ->orderBy('date_audience', 'desc')
                        ->take(5)
                        ->get();

        $stats = [
            'mes_dossiers_count' => $mesDossiers->count(),
            'mes_audiences_count' => $mesAudiences->count(),
        ];

        return view('dashboards.juge', compact('stats', 'mesDossiers', 'mesAudiences'));
    }

    if ($user->role === 'greffier') {
        $dossiersCount = Dossier::where('greffier_id', $user->id)->count();
        $courriersCount = Courrier::where('greffier_id', $user->id)->count();
        $audiencesCount = Audience::where('greffier_id', $user->id)->count(); // Ajouté

        $mesDossiers = Dossier::where('greffier_id', $user->id)
            ->orderBy('date_depot', 'desc')
            ->limit(5)
            ->get();

        $mesCourriers = Courrier::where('greffier_id', $user->id)
            ->orderBy('date_courrier', 'desc')
            ->limit(5)
            ->get();

        $mesAudiences = Audience::where('greffier_id', $user->id)
            ->orderBy('date_audience', 'desc')
            ->limit(5)
            ->get();

        return view('dashboards.greffier', compact(
            'dossiersCount',
            'courriersCount',
            'audiencesCount',
            'mesDossiers',
            'mesCourriers',
            'mesAudiences'
        ));
    }

    // Fallback : si rôle non géré, affiche un dashboard basique ou page d'erreur
    return view('dashboard');
}


    /**
     * Export PDF accessible uniquement aux admins
     */
    public function exportPdf()
    {
        $user = auth()->user();

        if ($user->role !== 'admin') {
            abort(403, 'Accès interdit');
        }

        $dossiers = Dossier::all();
        $audiences = Audience::all();
        $courriers = Courrier::all();

        $performanceJuges = User::where('role', 'juge')
            ->withCount([
                'dossiers as dossiers_en_cours_count' => fn($q) => $q->where('statut', 'en cours'),
                'dossiers as dossiers_clus_count' => fn($q) => $q->where('statut', 'clos'),
                'dossiers as dossiers_en_appel_count' => fn($q) => $q->where('statut', 'en appel'),
            ])
            ->get();

        $pdf = Pdf::loadView('exports.dashboard', compact('dossiers', 'audiences', 'courriers', 'performanceJuges'));

        return $pdf->download('dashboard_stats.pdf');
    }

    /**
     * Export Excel accessible uniquement aux admins
     */
    public function exportExcel()
    {
        $user = auth()->user();

        if ($user->role !== 'admin') {
            abort(403, 'Accès interdit');
        }

        return Excel::download(new DashboardExport, 'dashboard_stats.xlsx');
    }
}
