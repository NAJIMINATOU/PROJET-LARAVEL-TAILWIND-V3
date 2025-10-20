@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow p-6 rounded-lg">

    {{-- Message de succès (après mise à jour) --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-md mb-4 shadow-md">
            <strong class="font-semibold">Succès !</strong> {{ session('success') }}
        </div>
    @endif

    <h2 class="text-2xl font-bold mb-6 text-gray-700">✏️ Modifier le dossier</h2>

    <form action="{{ route('dossiers.update', $dossier->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700">Numéro de dossier</label>
            <input type="text" name="numero_dossier" value="{{ old('numero_dossier', $dossier->numero_dossier) }}"
                   class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" readonly>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Type d’affaire</label>
            <input type="text" name="type_affaire" value="{{ old('type_affaire', $dossier->type_affaire) }}"
                   class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
            @error('type_affaire')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Date de dépôt</label>
            <input type="date" name="date_depot" value="{{ old('date_depot', $dossier->date_depot) }}"
                   class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Statut</label>
            <select name="statut" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="en cours" {{ $dossier->statut == 'en cours' ? 'selected' : '' }}>En cours</option>
                <option value="clos" {{ $dossier->statut == 'clos' ? 'selected' : '' }}>Clos</option>
                <option value="en appel" {{ $dossier->statut == 'en appel' ? 'selected' : '' }}>En appel</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" rows="3"
                      class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $dossier->description) }}</textarea>
        </div>

        <div class="flex justify-between items-center pt-4">
            <a href="{{ route('dossiers.index') }}"
               class="px-5 py-2 bg-gray-200 text-gray-700 font-semibold rounded-md hover:bg-gray-300 transition">
                ⬅️ Retour
            </a>

            <button type="submit"
                    class="px-5 py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition">
                💾 Mettre à jour
            </button>
        </div>
    </form>
</div>
@endsection
