<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Locations Scrappées</title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">

    <h2 class="mb-4">Résultats du Scraping Immobilier</h2>

    <!-- Filtre par ville -->
    <form method="GET" action="{{ route('rentals.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <select name="city" class="form-select">
                    <option value="">-- Toutes les villes --</option>
                    @foreach($cities as $city)
                        <option value="{{ $city }}"
                            {{ $selectedCity == $city ? 'selected' : '' }}>
                            {{ $city }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <button class="btn btn-primary" type="submit">Filtrer</button>
            </div>
        </div>
    </form>

    <!-- Tableau -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
        <tr>
            <th>Nom / Titre</th>
            <th>Type Source</th>
            <th>Téléphone</th>
            <th>Email</th>
            <th>Type Bien</th>
            <th>Ville</th>
            <th>Quartier</th>
            <th>Qualifié</th>
        </tr>
        </thead>

        <tbody>
        @forelse($rentals as $r)
            <tr>
                <td>{{ $r->name_or_title }}</td>
                <td>{{ $r->source_type }}</td>
                <td>{{ $r->phone_number }}</td>
                <td>{{ $r->email }}</td>
                <td>{{ $r->property_type }}</td>
                <td>{{ $r->city }}</td>
                <td>{{ $r->district }}</td>
                <td>
                    @if($r->is_qualified)
                        <span class="badge bg-success">Oui</span>
                    @else
                        <span class="badge bg-danger">Non</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">Aucune donnée trouvée</td>
            </tr>
        @endforelse
        </tbody>
    </table>

</div>
</body>
</html>
