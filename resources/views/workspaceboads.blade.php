@extends('layouts.app')

@section('content')
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="h-10 {{ $workspace->color }} rounded mb-4 ">

        </div>
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900">{{ $workspace->name }}</h1>
            <a href="/create-board/{{ $workspace->id }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center gap-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                        clip-rule="evenodd" />
                </svg>
                Nouveau tableau
            </a>
        </div>

        <!-- Liste des tableaux -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <!-- Carte de tableau - Exemple 1 -->

            @forelse  ($workspace->boards as $item)
                <div
                    class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow overflow-hidden">
                    <div class="p-5">
                        <div class="flex justify-between items-start">
                            <h3 class="text-lg font-medium text-gray-900">{{ $item->name }} </h3>
                            <button class="text-gray-400 hover:text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                </svg>
                            </button>
                        </div>
                        {{-- <p class="text-gray-500 text-sm mt-2">Tâches en attente de priorisation</p> --}}
                        <div class="mt-4 flex justify-between items-center">
                            <a href="/show-task/{{$item->id}}" class="text-white w-full text-center py-1 rounded bg-blue-600 text-sm font-medium">Ouvrir →</a>
                        </div>
                        <div class=" flex justify-end">
                            <div class="mt-5">
                                <a onclick="return confirm('Etes vous sur  de vouloir supprimer ce tableau ?')"  href="/workspace/{{$item->id}}/delete">
                                    <i class="fa fa-trash text-red-500"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            @empty

                <div
                    class="bg-gray-50 rounded-lg border-2 border-dashed border-gray-300 hover:border-gray-400 transition-colors flex items-center justify-center min-h-[180px]">
                    <div class="text-center p-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <p class="mt-2 text-sm text-gray-500">Aucun tableau</p>
                    </div>
                </div>
            @endforelse



            <!-- Carte de tableau - Exemple 2 -->


            <!-- Carte vide (état quand aucun tableau) -->


        </div>
    </main>
@endsection
