@extends('layouts.app')

@section('content')
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Titre de la page -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Créer un Workspace</h1>
            <p class="text-gray-600 mt-2">Organisez vos projets en espaces de travail collaboratifs</p>
        </div>

        <!-- Formulaire de création -->
        <div class="bg-white shadow-md rounded-lg p-6 max-w-2xl">
            <form action="{{ route('save-workspace') }}" method="POST">

                @csrf

                <!-- Champ Nom -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom du Workspace</label>
                    <input type="text" id="name" name="name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror"
                        placeholder="Ex: Projet Marketing 2023" value="{{ old('name') }}">
                    {{-- Message d'erreur --}}
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Champ Couleur -->
                <div class="mb-8">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Couleur du Workspace</label>
                    <div class="flex flex-wrap gap-3">
                        @php
                            $colors = [
                                'bg-indigo-500' => 'Indigo',
                                'bg-blue-500' => 'Bleu',
                                'bg-green-500' => 'Vert',
                                'bg-yellow-500' => 'Jaune',
                                'bg-red-500' => 'Rouge',
                                'bg-purple-500' => 'Violet',
                            ];
                        @endphp


                        @foreach ($colors as $class => $label)
                            <div class="flex items-center">
                                <input type="radio" id="color-{{ $loop->index }}" name="color"
                                    value="{{ $class }}" class="hidden peer"
                                    {{ old('color', 'bg-indigo-500') === $class ? 'checked' : '' }}>
                                <label for="color-{{ $loop->index }}"
                                    class="flex items-center justify-center w-10 h-10 {{ $class }} rounded-full cursor-pointer peer-checked:ring-2 peer-checked:ring-offset-2 peer-checked:ring-gray-400"
                                    title="{{ $label }}">
                                </label>
                            </div>
                        @endforeach
                    </div>
                    {{-- Message d'erreur --}}
                    @error('color')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Boutons d'action -->
                <div class="flex justify-end space-x-4">
                    <a href="/my-workspace"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Annuler
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
                        Créer le Workspace
                    </button>
                </div>
            </form>
        </div>

       




        <!-- Section : Plans de souscription -->
        <div class="py-10">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Obtenez plus de Workspaces</h2>
            <p class="text-gray-600 mb-6">Choisissez un plan selon vos besoins.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Plan Freemium -->
                <div class="border rounded-lg p-6 shadow-sm bg-white">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Freemium</h3>
                    <p class="text-gray-600 mb-4">Idéal pour les utilisateurs individuels</p>
                    <ul class="text-sm text-gray-700 mb-4">
                        <li>✅ 1 Workspace</li>
                        <li>🔓 Accès de base</li>
                        <li>📦 Gratuit</li>
                    </ul>
                    <a href="{{ route('subscribe', ['plan' => 'freemium']) }}"
                        class="inline-block bg-gray-200 text-gray-800 px-4 py-2 rounded hover:bg-gray-300 transition">
                        Choisir Freemium
                    </a>
                </div>

                <!-- Plan Premium -->
                <div class="border rounded-lg p-6 shadow-md bg-white">
                    <h3 class="text-xl font-semibold text-indigo-600 mb-2">Premium</h3>
                    <p class="text-gray-600 mb-4">Parfait pour les petites équipes</p>
                    <ul class="text-sm text-gray-700 mb-4">
                        <li>✅ 5 Workspaces</li>
                        <li>📁 Fonctionnalités avancées</li>
                        <li>💳 9,99 €/mois</li>
                    </ul>
                    <a href="{{ route('subscribe', ['plan' => 'premium']) }}"
                        class="inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 transition">
                        Passer à Premium
                    </a>
                </div>

                <!-- Plan Business -->
                <div class="border rounded-lg p-6 shadow-lg bg-white">
                    <h3 class="text-xl font-semibold text-green-600 mb-2">Business</h3>
                    <p class="text-gray-600 mb-4">Pour les entreprises ambitieuses</p>
                    <ul class="text-sm text-gray-700 mb-4">
                        <li>✅ Workspaces illimités</li>
                        <li>📊 Statistiques détaillées</li>
                        <li>🔒 Support prioritaire</li>
                        <li>💳 29,99 €/mois</li>
                    </ul>
                    <a href="{{ route('subscribe', ['plan' => 'business']) }}"
                        class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                        Choisir Business
                    </a>
                </div>
            </div>

            <!-- Espace utilisateur -->
            <div class="mt-10 text-center">
                <p class="text-gray-700">Vous avez actuellement accès à <strong>{{ $workspacesNumber }}</strong>
                    workspace{{ $workspacesNumber > 1 ? 's' : '' }}.</p>
            </div>
        </div>







    </main>
@endsection
