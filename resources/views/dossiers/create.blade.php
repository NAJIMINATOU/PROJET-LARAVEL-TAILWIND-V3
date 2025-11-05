@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow p-6 rounded-lg">


    
    {{-- Carte de succès --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-md mb-4 shadow-md">
            <strong class="font-semibold">Succès !</strong> {{ session('success') }}
        </div>
    @endif



    <h2 class="text-2xl font-bold mb-6 text-gray-700">  <i class="fas fa-plus" style="font-size: 20px;"></i> Nouveau dossier judiciaire</h2>

    <form action="{{ route('dossiers.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-700">Numéro de dossier</label>
            <input type="text" name="numero_dossier" value="{{ old('numero_dossier') }}" 
                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 " required>
            @error('numero_dossier')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Type d’affaire</label>
            <input type="text" name="type_affaire" value="{{ old('type_affaire') }}" 
                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Date de dépôt</label>
            <input type="date" name="date_depot" value="{{ old('date_depot') }}" 
                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" required>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Statut</label>
            <select name="statut" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="en cours">En cours</option>
                <option value="clos">Clos</option>
                <option value="en appel">En appel</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" rows="3"
                      class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description') }}</textarea>
        </div>

        <div class="text-right">
            <button type="submit"
                    class="px-5 py-2 bg-indigo-600 text-black font-semibold rounded-md hover:bg-indigo-700 transition">
                <i class="far fa-save"></i>
 Enregistrer
            </button>
        </div>
    </form>

</div>
@endsection
