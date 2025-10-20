<!DOCTYPE html>
<html>
<head>
    <title>Audiences PDF</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Liste des audiences</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Salle</th>
                <th>Dossier</th>
                <th>Juge</th>
            </tr>
        </thead>
        <tbody>
            @foreach($audiences as $audience)
            <tr>
                <td>{{ $audience->id }}</td>
                <td>{{ $audience->date_audience }}</td>
                <td>{{ $audience->salle }}</td>
                <td>{{ $audience->dossier->numero_dossier ?? '' }}</td>
                <td>{{ $audience->user->name ?? '' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
