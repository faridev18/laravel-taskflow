<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>

<body>
    <div class="register-container">
        <h2>Inscription</h2>
        <form method="POST" action="{{ route('saveuser') }}" id="register-form">
            @csrf

            @if (session('success'))
                <span class="successmessage">{{ session('success') }}</span>
            @endif

            <div class="form-group">
                <label for="name">Nom :</label>
                @error('name')
                    <span class="errormessage">{{ $message }}</span>
                @enderror
                <input type="text" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="email">E-mail :</label>
                @error('email')
                    <span class="errormessage">{{ $message }}</span>
                @enderror
                <input type="text" id="email" name="email">
            </div>
            <div class="form-group">
                
                <label for="password">Mot de passe :</label>
                @error('password')
                    <span class="errormessage">{{ $message }}</span>
                @enderror
                <input type="password" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="repeat-password">Répéter le mot de passe :</label>
                @error('repeat-password')
                    <span class="errormessage">{{ $message }}</span>
                @enderror
                <input type="password" id="repeat-password" name="repeat-password">
            </div>
            <button type="submit">S'inscrire</button>
        </form>
    </div>

</body>

</html>
