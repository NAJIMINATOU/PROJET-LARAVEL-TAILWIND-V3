@extends('layouts.app')

@section('content')
<div class="bg-white shadow rounded-lg p-6">

     @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 p-3 rounded-lg mb-4 shadow-sm">
            {{ session('success') }}
        </div>
    @endif
    <h2 class="text-2xl font-bold text-gray-700 mb-4">            <i class="fa-solid fa-scale-unbalanced text-lg"></i>
 Liste des audiences</h2>

    <div class="flex justify-between items-center mb-4">

        <a href="{{ route('audiences.calendar') }}"
           class="bg-green-600 hover:bg-green-700 text-black font-semibold py-2 px-4 rounded-lg shadow transition">
           <i class="far fa-calendar"></i>
 Voir le calendrier
        </a>
@auth
    @if(in_array(auth()->user()->role, ['admin', 'greffier']))
        <a href="{{ route('audiences.create') }}"
           class="px-4 py-2 bg-indigo-600 text-black rounded-md hover:bg-indigo-700 transition">
           <i class="fas fa-plus" style="font-size: 20px;"></i> Nouvelle audience
        </a>
         @endif
@endauth
    </div>

   

    @if($audiences->count())
        <div class="overflow-x-auto">
            <table class="w-full border border-gray-300 rounded-lg text-sm">

                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 text-left">#</th>
                        <th class="py-2 px-4 text-left">Date</th>
                        <th class="py-2 px-4 text-left">Salle</th>
                        <th class="py-2 px-4 text-left">Dossier</th>
                        <th class="py-2 px-4 text-left">Juge</th>
                        <th class="py-2 px-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($audiences as $audience)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="py-2 px-4">{{ $audience->id }}</td>
                            <td class="py-2 px-4">{{ \Carbon\Carbon::parse($audience->date_audience)->format('d/m/Y H:i') }}</td>
                            <td class="py-2 px-4">{{ $audience->salle }}</td>
                            <td class="py-2 px-4">{{ $audience->dossier->numero_dossier ?? 'N/A' }}</td>
                            <td class="py-2 px-4">{{ $audience->user->name ?? 'N/A' }}</td>
                            <td class="py-2 px-4 text-center"><!-- Afficher "Éditer" et "Supprimer" uniquement pour admin et greffier -->
            @if(in_array(auth()->user()->role, ['admin', 'greffier']))
                                <a href="{{ route('audiences.edit', $audience->id) }}"
   class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-2 px-4 rounded-lg shadow transition">
                                                                                            <i class="fas fa-edit"></i>
</a>

                                <form action="{{ route('audiences.destroy', $audience) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Supprimer cette audience ?')"
                                            class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
                                                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>@endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $audiences->links() }}
        </div>
    @else
        <p class="text-gray-500">Aucune audience trouvée.</p>
    @endif
</div>
@endsection
