<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>

<body>
    <div class="register-container">
        <h2>Connexion</h2>
        <form method="POST" action="{{ route('connection') }}" id="register-form">
            @csrf
            
            @if (session('error'))
                <span class="errormessage">{{ session('error') }}</span>
            @endif

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
          
            <button type="submit">Se connecter</button>
        </form>
        <p>Vous n'avez pas de compte, <a href="/register">S'inscrire</a></p>
    </div>

</body>

</html>
