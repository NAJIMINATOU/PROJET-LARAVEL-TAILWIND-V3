<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Statistiques Dashboard</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; margin: 40px; }
        header {
            text-align: center;
            margin-bottom: 30px;
        }
        header img {
            max-height: 80px;
            margin-bottom: 10px;
        }
        h1, h2 {
            text-align: center;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            font-size: 11px;
        }
        th, td {
            border: 1px solid #444;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #ddd;
        }
        .performance-table th, .performance-table td {
            text-align: center;
        }
    </style>
</head>
<body>

<header>
    <img src="{{ public_path('images/4.png') }}" alt="Logo Ministère">
    <h1>Ministère de la Justice</h1>
</header>

<h2>Performance des juges</h2>
<table class="performance-table">
    <thead>
        <tr>
            <th>Nom du juge</th>
            <th>Dossiers en cours</th>
            <th>Dossiers clos</th>
            <th>Dossiers en appel</th>
            <th>Total dossiers</th>
        </tr>
    </thead>
    <tbody>
        @foreach($performanceJuges as $juge)
            @php
                $total = ($juge->dossiers_en_cours_count ?? 0) + ($juge->dossiers_clus_count ?? 0) + ($juge->dossiers_en_appel_count ?? 0);
            @endphp
            <tr>
                <td>{{ $juge->name }}</td>
                <td>{{ $juge->dossiers_en_cours_count ?? 0 }}</td>
                <td>{{ $juge->dossiers_clus_count ?? 0 }}</td>
                <td>{{ $juge->dossiers_en_appel_count ?? 0 }}</td>
                <td>{{ $total }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h2>Dossiers</h2>
<table>
    <thead>
        <tr>
            <th>Numéro</th>
            <th>Statut</th>
            <th>Juge</th>
            <th>Greffier</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dossiers as $dossier)
            <tr>
                <td>{{ $dossier->numero_dossier }}</td>
                <td>{{ $dossier->statut }}</td>
                <td>{{ optional($dossier->juge)->name ?? 'N/A' }}</td>
                <td>{{ optional($dossier->greffier)->name ?? 'N/A' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h2>Audiences</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Juge</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($audiences as $audience)
            <tr>
                <td>{{ $audience->id }}</td>
               <td>
    @if($audience->date_audience)
        @php
            try {
                $date = $audience->date_audience instanceof \Carbon\Carbon
                    ? $audience->date_audience
                    : \Carbon\Carbon::parse($audience->date_audience);
                echo $date->format('d/m/Y');
            } catch (\Exception $e) {
                echo 'Date invalide';
            }
        @endphp
    @else
        N/A
    @endif
</td>

                <td>{{ optional($audience->juge)->name ?? 'N/A' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h2>Courriers</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Objet</th>
            <th>Greffier</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($courriers as $courrier)
            <tr>
                <td>{{ $courrier->id }}</td>
                <td>{{ ucfirst($courrier->type) }}</td>
                <td>{{ $courrier->objet }}</td>
                <td>{{ optional($courrier->greffier)->name ?? 'N/A' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
