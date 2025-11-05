@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 px-6 py-8">

    <!-- 🎯 Titre principal -->
    <div class="flex items-center justify-between mb-10">
        <h2 class="text-2xl font-semibold text-gray-900 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-scale-unbalanced text-lg text-indigo-600"></i> 
            <span>Tableau de bord - juge</span>
        </h2>  
        <span class="text-sm text-gray-600">
            Dernière mise à jour : {{ now()->format('d/m/Y H:i') }}
        </span>
    </div>

    <!-- 💠 Cartes colorées -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">

        <!-- Carte 1 -->
        <div class="bg-white text-gray-900 rounded-2xl shadow-md p-6 hover:shadow-xl hover:scale-[1.05] transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm uppercase tracking-wide text-black-700">Mes Dossiers</h2>
                    <p class="text-4xl font-extrabold mt-2 text-indigo-900">{{ $stats['mes_dossiers_count'] }}</p>
                </div>
                <div class="bg-indigo-100 p-3 rounded-full">
                    <i class="fa-solid fa-folder-open text-2xl text-indigo-600"></i>
                </div>
            </div>
        </div>

        <!-- Carte 2 -->
        <div class="bg-white text-gray-900 rounded-2xl shadow-md p-6 hover:shadow-xl hover:scale-[1.05] transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm uppercase tracking-wide text-green-700">Mes Audiences</h2>
                    <p class="text-4xl font-extrabold mt-2 text-green-900">{{ $stats['mes_audiences_count'] }}</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <i class="fa-solid fa-gavel text-2xl text-green-600"></i>
                </div>
            </div>
        </div>

        <!-- Carte 3 -->
        <div class="bg-white text-gray-900 rounded-2xl shadow-md p-6 hover:shadow-xl hover:scale-[1.05] transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-sm uppercase tracking-wide text-yellow-700">Taux d’avancement</h2>
                    <p class="text-4xl font-extrabold mt-2 text-yellow-900">
                        {{ round(($stats['mes_dossiers_count'] ? ($stats['mes_audiences_count'] / $stats['mes_dossiers_count'] * 100) : 0), 1) }} %
                    </p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <i class="fa-solid fa-chart-line text-2xl text-yellow-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- 🗂️ Dossiers récents -->
    <section class="mb-12">
        <h2 class="text-2xl font-semibold text-gray-900 mb-4 flex items-center gap-2">
            <i class="fas fa-folder text-indigo-600" style="font-size: 1.5rem;"></i> Mes dossiers récents
        </h2>

        @if($mesDossiers->isEmpty())
            <div class="bg-white rounded-xl p-6 text-center text-gray-500 italic shadow">
                Aucun dossier disponible pour le moment.
            </div>
        @else
            <div class="overflow-x-auto bg-white rounded-xl shadow">
                <table class="min-w-full text-sm text-gray-800 border-collapse">
                    <thead class="bg-indigo-100 text-indigo-700 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-4 py-3 border-b text-left">N° Dossier</th>
                            <th class="px-4 py-3 border-b text-left">Type d'affaire</th>
                            <th class="px-4 py-3 border-b text-left">Date dépôt</th>
                            <th class="px-4 py-3 border-b text-left">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mesDossiers as $dossier)
                            <tr class="hover:bg-indigo-50 transition">
                                <td class="px-4 py-3 border-b">{{ $dossier->numero_dossier }}</td>
                                <td class="px-4 py-3 border-b">{{ $dossier->type_affaire }}</td>
                                <td class="px-4 py-3 border-b">
                                    {{ \Carbon\Carbon::parse($dossier->date_depot)->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3 border-b">
                                    <span class="
                                        px-3 py-1 rounded-full text-xs font-semibold
                                        @if($dossier->statut === 'en cours') bg-yellow-200 text-yellow-900
                                        @elseif($dossier->statut === 'clos') bg-green-200 text-green-900
                                        @elseif($dossier->statut === 'en appel') bg-blue-200 text-blue-900
                                        @else bg-gray-100 text-gray-700 @endif
                                    ">
                                        {{ ucfirst($dossier->statut) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>

    <!-- ⚖️ Audiences à venir -->
    <section>
        <h2 class="text-2xl font-semibold text-gray-900 mb-4 flex items-center gap-2">
            <i class="fa-solid fa-scale-unbalanced text-lg text-indigo-600"></i> Mes audiences à venir
        </h2>

        @if($mesAudiences->isEmpty())
            <div class="bg-white rounded-xl p-6 text-center text-gray-500 italic shadow">
                Aucune audience programmée.
            </div>
        @else
            <div class="overflow-x-auto bg-white rounded-xl shadow">
                <table class="min-w-full text-sm text-gray-800 border-collapse">
                    <thead class="bg-indigo-100 text-indigo-700 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-4 py-3 border-b text-left">Date audience</th>
                            <th class="px-4 py-3 border-b text-left">Salle</th>
                            <th class="px-4 py-3 border-b text-left">Affaire</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mesAudiences as $audience)
                            <tr class="hover:bg-indigo-50 transition">
                                <td class="px-4 py-3 border-b">
                                    {{ \Carbon\Carbon::parse($audience->date_audience)->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-4 py-3 border-b">{{ $audience->salle ?? 'Non précisé' }}</td>
                                <td class="px-4 py-3 border-b">
                                    {{ $audience->dossier->numero_dossier ?? 'N/A' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>

</div>
@endsection
