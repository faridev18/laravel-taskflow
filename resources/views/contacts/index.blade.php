<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des contacts</title>
</head>
<body>
    <nav>
        <a href="{{ url('/contacts') }}">Liste des contacts</a>
        <a href="{{ url('/addcontact') }}">Ajouter un contact</a>
    </nav>

    <h1>Liste des contacts</h1>

    <form method="GET" action="{{ url('/contacts') }}">
        <input type="text" name="search" placeholder="Rechercher par nom" value="{{ request('search') }}">
        <button type="submit">Rechercher</button>
    </form>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($contacts as $contact)
                <tr>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->phone }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Aucun contact trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination si utilisée --}}
    <div style="margin-top: 10px;">
        {{ $contacts->withQueryString()->links() }}
    </div>

</body>
</html>
