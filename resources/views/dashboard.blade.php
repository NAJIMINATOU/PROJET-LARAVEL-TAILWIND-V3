@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    @if(isset($stats['dossiers']))
        <div class="bg-white shadow rounded p-4">
            <h2 class="text-lg font-semibold">Dossiers</h2>
            <p class="text-2xl mt-2">{{ $stats['dossiers'] }}</p>
        </div>
    @endif

    @if(isset($stats['audiences']))
        <div class="bg-white shadow rounded p-4">
            <h2 class="text-lg font-semibold">Audiences</h2>
            <p class="text-2xl mt-2">{{ $stats['audiences'] }}</p>
        </div>
    @endif

    @if(isset($stats['courriers']))
        <div class="bg-white shadow rounded p-4">
            <h2 class="text-lg font-semibold">Courriers</h2>
            <p class="text-2xl mt-2">{{ $stats['courriers'] }}</p>
        </div>
    @endif

    @if(isset($stats['users']))
        <div class="bg-white shadow rounded p-4">
            <h2 class="text-lg font-semibold">Utilisateurs</h2>
            <p class="text-2xl mt-2">{{ $stats['users'] }}</p>
        </div>
    @endif
</div>
@endsection
