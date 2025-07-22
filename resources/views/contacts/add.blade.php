<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <nav>
        <a href="/contacts">Liste contacte</a>
        <a href="/addcontact">Add contacte</a>
    </nav>
    <form method="POST" action="/savecontact">
        @csrf

        @if (session('success'))
            <div style="color: green;">
                {{ session('success') }}
            </div>
        @endif


        <div>
            <input type="text" name="name" placeholder="Nom complet" value="{{ old('name') }}">
            @error('name')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <input type="text" name="email" placeholder="Adresse e-mail" value="{{ old('email') }}">
            @error('email')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <input type="text" name="phone" placeholder="Téléphone" value="{{ old('phone') }}">
            @error('phone')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Ajouter</button>
    </form>

</body>

</html>
