@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">➕ Ajouter un utilisateur</h1>

    <form action="{{ route('users.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md max-w-lg">
        @csrf
@if ($errors->any())
    <div class="mb-4 p-3 bg-red-100 border border-red-300 text-red-700 rounded">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <div class="mb-4">
            <label class="block font-semibold">Nom :</label>
            <input type="text" name="name" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Email :</label>
            <input type="email" name="email" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Rôle :</label>
            <select name="role" class="w-full border rounded p-2">
                <option value="admin">Admin</option>
                <option value="juge">Juge</option>
                <option value="greffier">Greffier</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Mot de passe :</label>
            <input type="password" name="password" class="w-full border rounded p-2" required>
        </div>
<div class="mb-4">
    <label class="block font-semibold">Confirmer le mot de passe :</label>
    <input type="password" name="password_confirmation" class="w-full border rounded p-2" required>
</div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Enregistrer</button>
    </form>
</div>
@endsection
