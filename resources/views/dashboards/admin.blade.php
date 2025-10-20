<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Tableau de bord Admin</h2>
    </x-slot>

    <div class="grid grid-cols-3 gap-4">
        <div class="bg-white p-4 shadow rounded">
            <h3 class="font-semibold">Nombre de dossiers</h3>
            <p>{{ $stats['dossiers'] ?? 0 }}</p>
        </div>

        <div class="bg-white p-4 shadow rounded">
            <h3 class="font-semibold">Nombre d'audiences</h3>
            <p>{{ $stats['audiences'] ?? 0 }}</p>
        </div>

        <div class="bg-white p-4 shadow rounded">
            <h3 class="font-semibold">Nombre des courriers</h3>
            <p>{{ $stats['courriers'] ?? 0 }}</p>
        </div>

        <div class="bg-white p-4 shadow rounded">
            <h3 class="font-semibold">Nombre d'utilisateurs</h3>
            <p>{{ $stats['users'] ?? 0 }}</p>
        </div>
    </div>
</x-app-layout>
