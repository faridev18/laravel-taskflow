@extends('layouts.app')

@section('content')
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Créer un tableau</h1>
        </div>
        <div class="bg-white shadow-md rounded-lg p-6 max-w-2xl">
            <form action="{{ route('saveboard') }}" method="POST">

                @csrf


                <input name="workspace_id" value="{{request()->id}}" type="hidden">

                <!-- Champ Nom -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nom du Tableau</label>
                    <input type="text" id="name" name="name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror"
                        placeholder="Tache entreprise, " value="{{ old('name') }}">
                    {{-- Message d'erreur --}}
                    @error('name')
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
                        Créer le Tableau
                    </button>
                </div>
            </form>
        </div>


    </main>
@endsection
