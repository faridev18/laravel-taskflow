<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskFlow - Gestion de projets collaboratifs</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#6366f1',
                        secondary: '#8b5cf6',
                    }
                }
            }
        }
    </script>
</head>

<body class="font-sans antialiased">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0 flex items-center">
                        <i class="fas fa-tasks text-primary text-2xl mr-2"></i>
                        <span class="text-xl font-bold text-gray-900">TaskFlow</span>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="#"
                            class="border-primary text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Accueil</a>
                        <a href="#"
                            class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Fonctionnalités</a>
                        <a href="#"
                            class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Tarifs</a>
                        <a href="#"
                            class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">Contact</a>
                    </div>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    @guest
                        <a href="/login"
                            class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">
                            Connexion
                        </a>
                        <a href="/register"
                            class="ml-4 bg-primary text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-indigo-700">
                            Inscription
                        </a>
                    @endguest

                    @auth
                        <a href="{{ route('my-workspace') }}"
                            class="text-gray-600 hover:text-gray-800 px-3 py-2 rounded-md text-sm font-medium">
                            Mes Espaces
                        </a>
                        <form method="GET" action="{{ route('logout') }}" class="ml-4">
                            @csrf
                            <button type="submit"
                                class="text-red-600 hover:text-red-800 px-3 py-2 rounded-md text-sm font-medium">
                                Déconnexion
                            </button>
                        </form>
                    @endauth
                </div>

                <div class="-mr-2 flex items-center sm:hidden">
                    <button type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none">
                        <span class="sr-only">Menu principal</span>
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-primary to-secondary">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">
                Gérez vos projets en toute simplicité
            </h1>
            <p class="mt-6 text-xl text-indigo-100 max-w-3xl mx-auto">
                TaskFlow révolutionne la gestion de vos projets avec une interface intuitive et des outils puissants
                pour booster votre productivité.
            </p>
            <div class="mt-10 flex justify-center space-x-4">
                <a href="/register"
                    class="bg-white text-primary px-8 py-3 rounded-md text-base font-medium hover:bg-gray-100 md:py-4 md:text-lg md:px-10">
                    Essai gratuit
                </a>
                <a href="#"
                    class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-md text-base font-medium hover:bg-white hover:text-primary md:py-4 md:text-lg md:px-10">
                    Voir la démo
                </a>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Tout ce dont vous avez besoin
                </h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                    Une suite complète d'outils pour gérer vos projets efficacement
                </p>
            </div>

            <div class="mt-16 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Feature 1 -->
                <div class="pt-6">
                    <div class="flow-root bg-gray-50 rounded-lg px-6 pb-8 h-full">
                        <div class="-mt-6">
                            <div
                                class="flex items-center justify-center h-12 w-12 rounded-md bg-primary text-white mx-auto">
                                <i class="fas fa-tasks text-xl"></i>
                            </div>
                            <h3 class="mt-8 text-lg font-medium text-gray-900 text-center">Tableaux Kanban</h3>
                            <p class="mt-5 text-base text-gray-500">
                                Visualisez l'avancement de vos tâches avec des tableaux personnalisables.
                                Glissez-déposez les tâches entre les colonnes.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="pt-6">
                    <div class="flow-root bg-gray-50 rounded-lg px-6 pb-8 h-full">
                        <div class="-mt-6">
                            <div
                                class="flex items-center justify-center h-12 w-12 rounded-md bg-primary text-white mx-auto">
                                <i class="fas fa-users text-xl"></i>
                            </div>
                            <h3 class="mt-8 text-lg font-medium text-gray-900 text-center">Collaboration en équipe</h3>
                            <p class="mt-5 text-base text-gray-500">
                                Travaillez en temps réel avec votre équipe. Commentaires, mentions et notifications pour
                                une collaboration fluide.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="pt-6">
                    <div class="flow-root bg-gray-50 rounded-lg px-6 pb-8 h-full">
                        <div class="-mt-6">
                            <div
                                class="flex items-center justify-center h-12 w-12 rounded-md bg-primary text-white mx-auto">
                                <i class="fas fa-chart-line text-xl"></i>
                            </div>
                            <h3 class="mt-8 text-lg font-medium text-gray-900 text-center">Analytiques avancées</h3>
                            <p class="mt-5 text-base text-gray-500">
                                Suivez les performances de votre équipe avec des rapports détaillés et des tableaux de
                                bord personnalisables.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials -->
    <div class="bg-gray-50">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-gray-900 text-center">
                Ils nous font confiance
            </h2>
            <div class="mt-16 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                <!-- Testimonial 1 -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <img class="h-12 w-12 rounded-full" src="https://randomuser.me/api/portraits/women/32.jpg"
                            alt="Client">
                        <div class="ml-4">
                            <h4 class="text-lg font-medium text-gray-900">Marie Dubois</h4>
                            <p class="text-gray-500">CEO @StartupTech</p>
                        </div>
                    </div>
                    <p class="mt-4 text-gray-600">
                        "TaskFlow a transformé notre façon de travailler. Notre productivité a augmenté de 40% depuis
                        son adoption."
                    </p>
                    <div class="mt-4 text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <img class="h-12 w-12 rounded-full" src="https://randomuser.me/api/portraits/men/43.jpg"
                            alt="Client">
                        <div class="ml-4">
                            <h4 class="text-lg font-medium text-gray-900">Jean Martin</h4>
                            <p class="text-gray-500">Directeur Marketing @AgencyOne</p>
                        </div>
                    </div>
                    <p class="mt-4 text-gray-600">
                        "L'interface est tellement intuitive que toute l'équipe l'a adoptée en quelques jours
                        seulement."
                    </p>
                    <div class="mt-4 text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="flex items-center">
                        <img class="h-12 w-12 rounded-full" src="https://randomuser.me/api/portraits/women/68.jpg"
                            alt="Client">
                        <div class="ml-4">
                            <h4 class="text-lg font-medium text-gray-900">Sophie Lambert</h4>
                            <p class="text-gray-500">Chef de projet @DigitalCorp</p>
                        </div>
                    </div>
                    <p class="mt-4 text-gray-600">
                        "La gestion des dépendances entre tâches est exceptionnelle. Un gain de temps énorme pour nos
                        projets complexes."
                    </p>
                    <div class="mt-4 text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-primary">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:py-16 sm:px-6 lg:px-8 lg:py-20">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                    <span class="block">Prêt à transformer votre productivité ?</span>
                </h2>
                <p class="mt-4 text-lg leading-6 text-indigo-100">
                    Essayez TaskFlow gratuitement pendant 14 jours. Aucune carte de crédit requise.
                </p>
                <p class="mt-8">
                    <a href="/register"
                        class=" bg-white text-primary px-8 py-3 rounded-md text-base font-medium hover:bg-gray-100 md:py-4 md:text-lg md:px-10">
                        Commencer maintenant
                    </a>
                </p>


            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-white text-sm font-semibold tracking-wider uppercase">Produit</h3>
                    <ul class="mt-4 space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white">Fonctionnalités</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Tarifs</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Applications</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white text-sm font-semibold tracking-wider uppercase">Entreprise</h3>
                    <ul class="mt-4 space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white">À propos</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Blog</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Carrières</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white text-sm font-semibold tracking-wider uppercase">Ressources</h3>
                    <ul class="mt-4 space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white">Documentation</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Support</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Webinaires</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white text-sm font-semibold tracking-wider uppercase">Légal</h3>
                    <ul class="mt-4 space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white">Confidentialité</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">CGU</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Mentions légales</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 border-t border-gray-700 pt-8 flex flex-col md:flex-row justify-between">
                <p class="text-gray-300 text-sm">
                    &copy; 2023 TaskFlow. Tous droits réservés.
                </p>
                <div class="mt-4 md:mt-0 flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="fab fa-github"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>
