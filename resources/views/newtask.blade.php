@extends('layouts.app')

@section('content')
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Créer une tache</h1>
        </div>
        <div class="bg-white shadow-md rounded-lg p-6 max-w-2xl">
            <form action="{{ route('savetask') }}" method="POST">

                @csrf


                <input name="board_id" value="{{ request()->id }}" type="hidden">

                <!-- Champ Nom -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Titre</label>
                    <input type="text" id="title" name="title"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('title') border-red-500 @enderror"
                        placeholder="" value="{{ old('title') }}">
                    {{-- Message d'erreur --}}
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>


                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>

                    <textarea
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-500 @enderror"
                        name="description" id="description"></textarea>
                    {{-- Message d'erreur --}}
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Champ Nom -->
                <div class="mb-6">
                    <label for="deadline" class="block text-sm font-medium text-gray-700 mb-2">Deadline</label>
                    <input type="date" id="deadline" name="deadline"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('deadline') border-red-500 @enderror"
                        placeholder="" value="{{ old('deadline') }}">
                    {{-- Message d'erreur --}}
                    @error('deadline')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="assigned_to" class="block text-sm font-medium text-gray-700 mb-2">Assigner à </label>


                    <select name="assigned_to" id="assigned_to"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('assigned_to') border-red-500 @enderror">
                        <option value="">Selectionnez un membre</option>
                        @foreach ($board->workspace->users as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach



                    </select>
                    {{-- Message d'erreur --}}
                    @error('assigned_to')
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
                        Créer la tache
                    </button>
                </div>
            </form>
        </div>


    </main>
@endsection
