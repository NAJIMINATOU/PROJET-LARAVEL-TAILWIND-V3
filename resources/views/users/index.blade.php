@extends('layouts.app')

@section('content')
<div class="container bg-white mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800"><i class="fas fa-users"></i>
 Liste des utilisateurs</h1>
        <a href="{{ route('users.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">+ Ajouter</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    <table class="min-w-full border border-gray-300 bg-white">
        <thead class="bg-gray-100">
            <tr>
                <th class="py-2 px-4 border">Nom</th>
                <th class="py-2 px-4 border">Email</th>
                <th class="py-2 px-4 border">Rôle</th>
                <th class="py-2 px-4 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td class="py-2 px-4 border">{{ $user->name }}</td>
                <td class="py-2 px-4 border">{{ $user->email }}</td>
                <td class="py-2 px-4 border capitalize">{{ $user->role }}</td>
                <td class="py-2 px-4 border text-center">
                    
                            <!-- Modifier -->
                            <a href="{{ route('users.edit', $user->id) }}"
                               class="text-yellow-500 hover:text-yellow-600"
                               title="Modifier">
                                <i class="fas fa-edit text-lg"></i>
                            </a> 

                    <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Supprimer cet utilisateur ?')">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">                                <i class="fas fa-trash-alt"></i>
</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
