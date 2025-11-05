@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">                    <i class="fa-solid fa-folder-open text-2xl text-600"></i>
Tableau de bord - Greffier</h1>

    <div class="grid grid-cols-3 gap-6">
        <div class="bg-blue-100 p-4 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Dossiers</h2>
            <p class="text-2xl font-bold">{{ $dossiersCount }}</p>
        </div>

        <div class="bg-green-100 p-4 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Audiences</h2>
            <p class="text-2xl font-bold">{{ $audiencesCount }}</p>
        </div>

        <div class="bg-yellow-100 p-4 rounded-lg shadow">
            <h2 class="text-lg font-semibold">Courriers</h2>
            <p class="text-2xl font-bold">{{ $courriersCount }}</p>
        </div>
    </div>
</div>
@endsection
