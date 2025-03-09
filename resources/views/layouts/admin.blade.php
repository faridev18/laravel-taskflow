<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tableau de bord - {{ config('app.name') }}</title>
    <!-- Tailwind CSS (vous pouvez utiliser un CDN ou installer via npm) -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome pour les icônes -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Styles personnalisés -->
    <style>
        .sidebar {
            transition: all 0.3s ease;
        }
        .sidebar.collapsed {
            width: 80px;
        }
        .sidebar.collapsed .nav-text {
            display: none;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Conteneur principal -->
    <div class="flex h-screen">
        <!-- Barre latérale (Sidebar) -->
        <div class="sidebar bg-blue-800 text-white w-64 space-y-6 py-7 px-2">
            <!-- Logo -->
            <div class="flex items-center justify-between px-4">
                <h1 class="text-2xl font-bold">
                    <a href="{{ route('dashboard') }}">MyApp</a>
                </h1>
                <button id="toggleSidebar" class="text-white focus:outline-none">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <!-- Menu de navigation -->

            @include('partials.nav')




        </div>

        <!-- Contenu principal -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Barre de navigation (Navbar) -->
            <header class="bg-white shadow">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center">
                        <h2 class="text-xl font-semibold">Tableau de bord</h2>
                    </div>
                    <div class="flex items-center space-x-4">
                        <!-- Notification -->
                        <a href="#" class="text-gray-600 hover:text-gray-900">
                            <i class="fas fa-bell"></i>
                        </a>
                        <!-- Profil utilisateur -->
                        <div class="relative">
                            <button id="userMenuButton" class="focus:outline-none">
                                <img src="https://via.placeholder.com/40" alt="Profil" class="rounded-full">
                            </button>
                            <!-- Menu déroulant -->
                            <div id="userMenu" class="hidden absolute right-0 mt-2 w-48 bg-white border rounded-lg shadow-lg">
                                <a href="{{ route('profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profil</a>
                                <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Déconnexion</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Contenu dynamique -->
            <main  class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 p-6 ba">
                @yield('content')         
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Toggle sidebar
        document.getElementById('toggleSidebar').addEventListener('click', function () {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('collapsed');
        });

        // Toggle user menu
        document.getElementById('userMenuButton').addEventListener('click', function () {
            const userMenu = document.getElementById('userMenu');
            userMenu.classList.toggle('hidden');
        });

        // Fermer le menu utilisateur en cliquant à l'extérieur
        document.addEventListener('click', function (event) {
            const userMenuButton = document.getElementById('userMenuButton');
            const userMenu = document.getElementById('userMenu');
            if (!userMenuButton.contains(event.target) {
                userMenu.classList.add('hidden');
            }
        });
    </script>
</body>
</html>