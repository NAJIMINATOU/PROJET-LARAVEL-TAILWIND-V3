@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">✏️ Modifier un utilisateur</h1>
        <a href="{{ route('users.index') }}" class="text-blue-600 hover:underline">
            ← Retour à la liste
        </a>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md max-w-lg mx-auto">
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nom -->
            <div class="mb-4">
                <label class="block font-semibold text-gray-700 mb-1">Nom :</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring focus:ring-blue-200"
                    required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block font-semibold text-gray-700 mb-1">Email :</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring focus:ring-blue-200"
                    required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Rôle -->
            <div class="mb-4">
                <label class="block font-semibold text-gray-700 mb-1">Rôle :</label>
                <select name="role" class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring focus:ring-blue-200">
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="juge" {{ $user->role === 'juge' ? 'selected' : '' }}>Juge</option>
                    <option value="greffier" {{ $user->role === 'greffier' ? 'selected' : '' }}>Greffier</option>
                </select>
                @error('role')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mot de passe -->
            <div class="mb-4">
                <label class="block font-semibold text-gray-700 mb-1">Nouveau mot de passe (facultatif) :</label>
                <input type="password" name="password"
                    class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring focus:ring-blue-200"
                    placeholder="Laisser vide pour ne pas changer">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirmation mot de passe -->
            <div class="mb-6">
                <label class="block font-semibold text-gray-700 mb-1">Confirmer le mot de passe :</label>
                <input type="password" name="password_confirmation"
                    class="w-full border-gray-300 rounded-lg shadow-sm p-2 focus:ring focus:ring-blue-200"
                    placeholder="Confirmer le mot de passe">
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    💾 Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
