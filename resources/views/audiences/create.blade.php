@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow p-6 rounded-lg">
    <h2 class="text-2xl font-bold mb-6 text-gray-700">➕ Nouvelle audience</h2>

    <form action="{{ route('audiences.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700">Date et heure de l’audience</label>
            <input type="datetime-local" name="date_audience"
                   class="w-full border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                   required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Salle</label>
            <input type="text" name="salle" class="w-full border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Dossier associé</label>
            <select name="dossier_id" class="w-full border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
                <option value="">-- Sélectionner un dossier --</option>
                @foreach($dossiers as $dossier)
                    <option value="{{ $dossier->id }}">{{ $dossier->numero_dossier }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Juge</label>
            <select name="user_id" class="w-full border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" required>
                <option value="">-- Sélectionner un juge --</option>
                @foreach($juges as $juge)
                    <option value="{{ $juge->id }}">{{ $juge->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="text-right">
            <button type="submit"
                    class="px-5 py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 transition">
                💾 Enregistrer
            </button>
        </div>
    </form>
</div>
@endsection
