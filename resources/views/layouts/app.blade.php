<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Workspaces - TaskFlow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <h1 class="text-xl font-bold text-indigo-600">TaskFlow</h1>
                <nav class="hidden md:flex space-x-8">
                    <a href="#" class="text-gray-700 hover:text-indigo-600">Tableau de bord</a>
                    <a href="/my-workspace" class="text-gray-700 hover:text-indigo-600">Mes Workspaces</a>
                    {{-- <a href="#" class="text-gray-700 hover:text-indigo-600">Tâches</a> --}}
                </nav>
            </div>
            <div class="flex items-center space-x-4">
                <button class="p-2 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-bell"></i>
                </button>
                <div class="relative">
                    <img src="https://ui-avatars.com/api/?name=John+Doe" alt="Profil"
                        class="w-8 h-8 rounded-full cursor-pointer">
                </div>
                <a href="/logout" type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    <i class="fas fa-sign-out-alt mr-2"></i> Déconnexion
                </a>
            </div>
        </div>
    </header>

    @yield('content')


</body>

</html>
