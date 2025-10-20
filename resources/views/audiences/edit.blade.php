@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-700 mb-6">✏️ Modifier l'audience #{{ $audience->id }}</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-300 text-red-800 p-3 rounded-lg mb-4 shadow-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('audiences.update', $audience->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Date -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2" for="date_audience">Date de l'audience</label>
                <input type="datetime-local" name="date_audience" id="date_audience"
                       value="{{ \Carbon\Carbon::parse($audience->date_audience)->format('Y-m-d\TH:i') }}"
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <!-- Salle -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2" for="salle">Salle</label>
                <input type="text" name="salle" id="salle" value="{{ $audience->salle }}"
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <!-- Dossier -->
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2" for="dossier_id">Dossier</label>
                <select name="dossier_id" id="dossier_id"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    @foreach ($dossiers as $dossier)
                        <option value="{{ $dossier->id }}"
                            {{ $audience->dossier_id == $dossier->id ? 'selected' : '' }}>
                            {{ $dossier->numero_dossier }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Juge -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2" for="user_id">Juge</label>
                <select name="user_id" id="user_id"
                        class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    @foreach ($juges as $juge)
                        <option value="{{ $juge->id }}"
                            {{ $audience->user_id == $juge->id ? 'selected' : '' }}>
                            {{ $juge->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Boutons -->
            <div class="flex justify-between items-center">
                <a href="{{ route('audiences.index') }}"
                   class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition">
                   ← Retour à la liste
                </a>

                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg shadow transition">
                    💾 Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
