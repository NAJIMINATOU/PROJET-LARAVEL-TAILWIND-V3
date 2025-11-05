@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8 text-center">
   <h1 class="text-3xl font-bold text-gray-800 mb-6 flex items-center gap-2">
  <div class="text-purple-700 w-6 h-6 flex-shrink-0">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3v18h18" />
      <rect x="7" y="10" width="2" height="7" fill="currentColor" />
      <rect x="11" y="7" width="2" height="10" fill="currentColor" />
      <rect x="15" y="4" width="2" height="13" fill="currentColor" />
    </svg>
  </div>
  Tableau de bord - Admin
</h1>

    <!-- 🔹 Statistiques principales -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Dossiers -->
        <div class="bg-blue-100 p-4 rounded-lg shadow flex flex-col items-center gap-4">
            <div class="text-blue-700 text-3xl">
                <i class="fas fa-folder-open"></i>
            </div>
            <div>
                <h2 class="text-xl font-semibold">Dossiers</h2>
                <p class="text-2xl font-bold">{{ $stats['dossiers_total'] }}</p>
                <p>Ouverts : <strong>{{ $stats['dossiers_en_cours'] }}</strong></p>
                <p>Clôturés : <strong>{{ $stats['dossiers_clus'] }}</strong></p>
                <p>En appel : <strong>{{ $stats['dossiers_en_appel'] }}</strong></p>
            </div>
        </div>

        <!-- Audiences -->
        <div class="bg-green-100 p-4 rounded-lg shadow flex flex-col items-center gap-4">
            <div class="text-green-700 text-3xl">
                <i class="fas fa-gavel"></i>
            </div>
            <div>
                <h2 class="text-xl font-semibold">Audiences</h2>
                <p class="text-2xl font-bold">{{ $stats['audiences_total'] }}</p>
            </div>
        </div>

        <!-- Courriers -->
        <div class="bg-yellow-100 p-4 rounded-lg shadow flex flex-col items-center gap-4">
            <div class="text-yellow-700 text-3xl">
                <i class="fas fa-envelope"></i>
            </div>
            <div>
                <h2 class="text-xl font-semibold">Courriers</h2>
                <p class="text-2xl font-bold">{{ $stats['courriers_total'] }}</p>
                <p>Entrants : <strong>{{ $stats['courriers_entrants'] }}</strong></p>
                <p>Sortants : <strong>{{ $stats['courriers_sortants'] }}</strong></p>
            </div>
        </div>

        <!-- Utilisateurs -->
        <div class="bg-purple-100 p-4 rounded-lg shadow flex flex-col items-center gap-4">
            <div class="text-purple-700 text-3xl">
                <i class="fas fa-users"></i>
            </div>
            <div>
                <h2 class="text-xl font-semibold">Utilisateurs</h2>
                <p class="text-2xl font-bold">{{ $stats['total_users'] ?? 0 }}</p>
            </div>
        </div>
    </div>

    <!-- 🔹 Performance des juges avec Doughnut Chart -->
    <div class="bg-white p-6 rounded-lg shadow mb-6">
        <h2 class="text-xl font-bold mb-4"><i class="fas fa-balance-scale"></i> Performance des juges</h2>

        @if($performanceJuges->isEmpty())
            <p class="text-gray-500">Aucun juge enregistré.</p>
        @else
            <canvas id="jugesChart" class="w-64 h-64 mx-auto"></canvas>
        @endif
    </div>

    <!-- 🔹 Boutons export -->
    <div class="flex justify-center gap-2 mt-4">
        <a href="{{ route('dashboard.export.pdf') }}" 
           class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition flex items-center gap-2">
           <i class="fas fa-file-pdf"></i> Exporter PDF
        </a>
        <a href="{{ route('dashboard.export.excel') }}" 
           class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition flex items-center gap-2">
           <i class="fas fa-file-excel"></i> Exporter Excel
        </a>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@if(!$performanceJuges->isEmpty())
<script>
    // 🔹 Données depuis Laravel
    const labels = {!! json_encode($performanceJuges->pluck('name')) !!};
    const enCoursArray = {!! json_encode($performanceJuges->pluck('dossiers_en_cours_count')->map(fn($v) => $v ?? 0)) !!};
    const closArray = {!! json_encode($performanceJuges->pluck('dossiers_clus_count')->map(fn($v) => $v ?? 0)) !!};
    const enAppelArray = {!! json_encode($performanceJuges->pluck('dossiers_en_appel_count')->map(fn($v) => $v ?? 0)) !!};

    // 🔹 Total des dossiers par juge (même si 0)
    const totalDossiers = enCoursArray.map((v, i) => {
        const total = v + closArray[i] + enAppelArray[i];
        // Si total = 0, on met une très petite valeur pour garder la couleur visible
        return total > 0 ? total : 0.001;
    });

    // 🔹 Couleurs distinctes (boucle infinie si plus de juges)
    const presetColors = ['#FF6384', '#36A2EB', '#FFCE56', '#8A2BE2', '#4BC0C0', '#9966FF'];
    const colors = labels.map((_, i) => presetColors[i % presetColors.length]);

    // 🔹 Initialisation du graphique
    const ctx = document.getElementById('jugesChart').getContext('2d');

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total dossiers',
                data: totalDossiers,
                backgroundColor: colors,
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { boxWidth: 20, padding: 15 }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const index = context.dataIndex;
                            return `${labels[index]} : ${enCoursArray[index]} en cours, ${closArray[index]} clos, ${enAppelArray[index]} en appel (Total: ${totalDossiers[index].toFixed(0)})`;
                        }
                    }
                }
            },
            animation: { duration: 1000, easing: 'easeOutQuart' }
        }
    });
</script>
@endif

@endsection
