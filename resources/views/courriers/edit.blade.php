@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">✏️ Modifier un courrier</h2>

    <form action="{{ route('courriers.update', $courrier) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid gap-4">
            <div>
                <label class="block font-semibold text-gray-700">Type :</label>
                <select name="type" class="w-full border-gray-300 rounded-lg shadow-sm">
                    <option value="entrant" {{ $courrier->type == 'entrant' ? 'selected' : '' }}>Entrant</option>
                    <option value="sortant" {{ $courrier->type == 'sortant' ? 'selected' : '' }}>Sortant</option>
                </select>
            </div>

            <div>
                <label class="block font-semibold text-gray-700">Date du courrier :</label>
                <input type="date" name="date_courrier" value="{{ $courrier->date_courrier }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm">
            </div>

            <div>
                <label class="block font-semibold text-gray-700">Expéditeur :</label>
                <input type="text" name="expediteur" value="{{ $courrier->expediteur }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm">
            </div>

            <div>
                <label class="block font-semibold text-gray-700">Destinataire :</label>
                <input type="text" name="destinataire" value="{{ $courrier->destinataire }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm">
            </div>

            <div>
                <label class="block font-semibold text-gray-700">Statut :</label>
                <select name="status" class="w-full border-gray-300 rounded-lg shadow-sm">
                    <option value="en_cours" {{ $courrier->status == 'en_cours' ? 'selected' : '' }}>En cours</option>
                    <option value="traite" {{ $courrier->status == 'traite' ? 'selected' : '' }}>Traité</option>
                    <option value="archive" {{ $courrier->status == 'archive' ? 'selected' : '' }}>Archivé</option>
                </select>
            </div>

            <div>
                <label class="block font-semibold text-gray-700">Pièce jointe :</label>
                <input type="file" name="fichier" class="w-full border-gray-300 rounded-lg shadow-sm">
                @if ($courrier->fichier)
                    <p class="mt-2 text-sm text-gray-600">
                        📎 <a href="{{ asset('storage/' . $courrier->fichier) }}" target="_blank" class="text-blue-600 hover:underline">
                            Voir le fichier actuel
                        </a>
                    </p>
                @endif
            </div>
        </div>

        <div class="mt-6 flex justify-between">
            <a href="{{ route('courriers.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Annuler
            </a>
            <button type="submit" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">
                💾 Enregistrer les modifications
            </button>
        </div>
    </form>
</div>
@endsection
