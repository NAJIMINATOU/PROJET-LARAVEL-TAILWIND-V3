@extends('layouts.app')

@section('content')
<div class="p-6 bg-white shadow rounded">
    <h1 class="text-2xl font-bold">Dashboard Juge</h1>
    <p class="mt-2 text-gray-600">Bienvenue {{ auth()->user()->name }} ({{ auth()->user()->role }})</p>

    <div class="mt-6 grid grid-cols-2 gap-6">
        <a href="{{ route('dossiers.index') }}" class="p-4 bg-green-100 rounded shadow hover:bg-green-200">📂 Voir mes dossiers</a>
        <a href="{{ route('audiences.index') }}" class="p-4 bg-yellow-100 rounded shadow hover:bg-yellow-200">⚖️ Consulter audiences</a>
    </div>
</div>
@endsection
