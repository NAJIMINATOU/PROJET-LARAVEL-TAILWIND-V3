@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center h-screen text-center">
    <h1 class="text-6xl font-bold text-red-600 mb-4">403</h1>
    <p class="text-lg text-gray-700 mb-6">🚫 Accès refusé — vous n’avez pas les droits nécessaires.</p>
    <a href="{{ url('/') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Retour à l'accueil
    </a>
</div>
@endsection
