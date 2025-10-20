@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6">
    <h2 class="text-2xl font-bold text-gray-700 mb-6">📁 Gestion des dossiers</h2>

    {{-- ✅ Message de succès --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-md mb-6 shadow-md">
            <strong class="font-semibold">Succès !</strong> {{ session('success') }}
        </div>
    @endif

    {{-- 🔍 Barre de recherche --}}
    <form method="GET" action="{{ route('dossiers.index') }}" class="flex flex-wrap items-center gap-3 mb-6">
        <input type="text" name="numero_dossier" placeholder="🔎 Numéro de dossier"
               value="{{ request('numero_dossier') }}"
               class="border border-gray-300 rounded-md px-3 py-2 w-60 focus:ring-indigo-500 focus:border-indigo-500">

        <input type="text" name="type_affaire" placeholder="Type d’affaire"
               value="{{ request('type_affaire') }}"
               class="border border-gray-300 rounded-md px-3 py-2 w-60 focus:ring-indigo-500 focus:border-indigo-500">

        <input type="date" name="date_depot"
               value="{{ request('date_depot') }}"
               class="border border-gray-300 rounded-md px-3 py-2 w-48 focus:ring-indigo-500 focus:border-indigo-500">

        <button type="submit"
                class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition">
            🔍 Rechercher
        </button>

        <a href="{{ route('dossiers.index') }}"
           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
            ♻️ Réinitialiser
        </a>

        <div class="ml-auto">
            <a href="{{ route('dossiers.create') }}"
               class="px-4 py-2 bg-green-600 text-black rounded-md hover:bg-green-700 transition">
               ➕ Nouveau dossier
            </a>
        </div>
    </form>

    {{-- 🧾 Tableau des dossiers --}}
    @if($dossiers->count())
        <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 rounded-lg text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 text-left border-b">#</th>
                        <th class="py-2 px-4 text-left border-b">N° Dossier</th>
                        <th class="py-2 px-4 text-left border-b">Type</th>
                        <th class="py-2 px-4 text-left border-b">Date dépôt</th>
                        <th class="py-2 px-4 text-left border-b">Statut</th>
                        <th class="py-2 px-4 text-center border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dossiers as $dossier)
                        <tr class="hover:bg-gray-50 border-b">
                            <td class="py-2 px-4">{{ $dossier->id }}</td>
                            <td class="py-2 px-4">{{ $dossier->numero_dossier }}</td>
                            <td class="py-2 px-4">{{ $dossier->type_affaire }}</td>
                            <td class="py-2 px-4">{{ $dossier->date_depot }}</td>
                            <td class="py-2 px-4">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold 
                                    {{ $dossier->statut == 'en cours' ? 'bg-yellow-100 text-yellow-800' : 
                                       ($dossier->statut == 'clos' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800') }}">
                                    {{ ucfirst($dossier->statut) }}
                                </span>
                            </td>
                            <td class="py-2 px-4 text-center">
                                <a href="{{ route('dossiers.edit', $dossier) }}"
                                   class="px-3 py-1 bg-blue-600 text-black text-sm rounded hover:bg-blue-700 transition">
                                    ✏️ Éditer
                                </a>
                                <form action="{{ route('dossiers.destroy', $dossier) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Voulez-vous vraiment supprimer ce dossier ?')"
                                            class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700 transition">
                                        🗑️ Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $dossiers->links() }}
        </div>
    @else
        <p class="text-gray-500">Aucun dossier trouvé.</p>
    @endif
</div>
@endsection
