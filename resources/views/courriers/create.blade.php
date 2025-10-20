@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-semibold text-gray-700 mb-6">
        ✉️ Nouveau Courrier
    </h2>

    <form action="{{ route('courriers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-2 gap-4">
            <!-- Référence automatique -->
            <div>
                <label class="block text-gray-600">Référence (auto)</label>
                <input type="text" name="reference" value="{{ old('reference', 'CR-' . strtoupper(Str::random(6))) }}" readonly
                       class="w-full mt-1 bg-gray-100 border-gray-300 rounded-lg">
            </div>

            <!-- Type -->
            <div>
                <label class="block text-gray-600">Type</label>
                <select name="type" class="w-full mt-1 border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <option value="entrant" {{ old('type') == 'entrant' ? 'selected' : '' }}>Entrant</option>
                    <option value="sortant" {{ old('type') == 'sortant' ? 'selected' : '' }}>Sortant</option>
                </select>
            </div>

            <!-- Date -->
            <div>
                <label class="block text-gray-600">Date du courrier</label>
                <input type="date" name="date_courrier" value="{{ old('date_courrier') }}"
                       class="w-full mt-1 border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Expéditeur -->
            <div>
                <label class="block text-gray-600">Expéditeur</label>
                <input type="text" name="expediteur" value="{{ old('expediteur') }}"
                       class="w-full mt-1 border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Destinataire -->
            <div>
                <label class="block text-gray-600">Destinataire</label>
                <input type="text" name="destinataire" value="{{ old('destinataire') }}"
                       class="w-full mt-1 border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Dossier -->
            <div>
                <label class="block text-gray-600">Dossier associé</label>
                <select name="id_dossier" class="w-full mt-1 border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Aucun</option>
                    @foreach($dossiers as $dossier)
                        
                         <option value="{{ $dossier->id }}" {{ old('id_dossier') == $dossier->id ? 'selected' : '' }}>
                        {{ $dossier->numero_dossier }} - {{ $dossier->type_affaire }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Pièce jointe -->
            <div class="col-span-2">
                <label class="block text-gray-600">Pièce jointe (PDF, image, Word...)</label>
                <input type="file" name="fichier"
                       accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                       class="w-full mt-1 border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>

        <!-- Boutons -->
        <div class="mt-6 flex justify-between">
            <a href="{{ route('courriers.index') }}" class="text-gray-600 hover:text-gray-800">
                ← Retour à la liste
            </a>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                ✅ Enregistrer
            </button>
        </div>
    </form>
</div>
@endsection
