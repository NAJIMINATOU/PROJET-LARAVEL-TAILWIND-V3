@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

    <!-- 1️⃣ Editer les informations du profil -->
    <div class="bg-white shadow rounded p-6">
        <h2 class="text-xl font-bold mb-4">Modifier vos informations</h2>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <!-- Nom -->
            <div class="mb-4">
                <label for="name" class="block font-medium text-sm text-gray-700">Nom</label>
                <input id="name" name="name" type="text" value="{{ old('name', auth()->user()->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', auth()->user()->email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Mettre à jour</button>
        </form>
    </div>

    <!-- 2️⃣ Changer le mot de passe -->
    <div class="bg-white shadow rounded p-6">
        <h2 class="text-xl font-bold mb-4">Changer votre mot de passe</h2>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('PUT')

            <!-- Mot de passe actuel -->
            <div class="mb-4">
                <label for="current_password" class="block font-medium text-sm text-gray-700">Mot de passe actuel</label>
                <input id="current_password" name="current_password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('current_password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Nouveau mot de passe -->
            <div class="mb-4">
                <label for="password" class="block font-medium text-sm text-gray-700">Nouveau mot de passe</label>
                <input id="password" name="password" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('password') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- Confirmation mot de passe -->
            <div class="mb-4">
                <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Confirmer le mot de passe</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Mettre à jour le mot de passe</button>
        </form>
    </div>

    <!-- 3️⃣ Supprimer le compte -->
    <div class="bg-white shadow rounded p-6">
        <h2 class="text-xl font-bold mb-4">Supprimer votre compte</h2>
        <p class="text-sm text-gray-600 mb-4">Une fois votre compte supprimé, toutes vos données seront perdues définitivement.</p>

        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('DELETE')

            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded" onclick="return confirm('Voulez-vous vraiment supprimer votre compte ?')">Supprimer mon compte</button>
        </form>
    </div>

</div>
@endsection
