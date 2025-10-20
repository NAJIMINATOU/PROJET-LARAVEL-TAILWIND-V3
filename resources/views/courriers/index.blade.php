@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6">

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-700">📬 Gestion des Courriers</h2>

        <a href="{{ route('courriers.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Nouveau courrier
        </a>
    </div>

    <!-- Barre de recherche -->
    <form method="GET" action="{{ route('courriers.index') }}" class="mb-4 flex gap-2">
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Rechercher par référence, expéditeur, destinataire..."
               class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">

        <button type="submit"
                class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-900 transition">
            Rechercher
        </button>
    </form>

    <!-- Tableau des courriers -->
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 rounded-lg">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="py-2 px-4 text-left">Référence</th>
                    <th class="py-2 px-4 text-left">Type</th>
                    <th class="py-2 px-4 text-left">Date</th>
                    <th class="py-2 px-4 text-left">Expéditeur</th>
                    <th class="py-2 px-4 text-left">Destinataire</th>
                    <th class="py-2 px-4 text-left">Pièce jointe</th>
                    <th class="py-2 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse ($courriers as $courrier)
                <tr class="border-t hover:bg-gray-50">
                    <td class="py-2 px-4">{{ $courrier->reference }}</td>
                    <td class="py-2 px-4">
                        <span class="px-2 py-1 rounded text-white 
                            {{ $courrier->type === 'entrant' ? 'bg-green-600' : 'bg-blue-600' }}">
                            {{ ucfirst($courrier->type) }}
                        </span>
                    </td>
                    <td class="py-2 px-4">{{ $courrier->date_courrier }}</td>
                    <td class="py-2 px-4">{{ $courrier->expediteur }}</td>
                    <td class="py-2 px-4">{{ $courrier->destinataire }}</td>
                    <td class="py-2 px-4">
      @if ($courrier->fichier)
                                <a href="{{ asset('storage/' . $courrier->fichier) }}" target="_blank"
                                    class="text-blue-600 hover:text-blue-800" title="Voir la pièce jointe">
                                    👁️ Voir
                                </a>
                            @else
                                <span class="text-gray-400">Aucun</span>
                            @endif

                            
</td>

                    <td class="py-2 px-4 flex gap-2">
                        <form action="{{ route('courriers.update', $courrier) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <a href="{{ route('courriers.edit', $courrier->id) }}" 
                           class="text-yellow-500 hover:text-yellow-600">
                            <i class="fas fa-edit"></i>
                        </a>
</form>

                        
                        <form action="{{ route('courriers.destroy', $courrier->id) }}" method="POST" onsubmit="return confirm('Supprimer ce courrier ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-500">Aucun courrier trouvé.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $courriers->links() }}
    </div>
</div>
@endsection
