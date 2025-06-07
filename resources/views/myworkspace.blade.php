@extends('layouts.app')
@section('content')

 <!-- Main Content -->
 <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Mes Workspaces</h2>
        <!-- Add Workspace Button -->
        <a href="/create-workspace" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2 transition-colors">
            <i class="fas fa-plus"></i>
            <span>Nouveau Workspace</span>
        </a>
    </div>

    <!-- Workspace Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Workspace Card 1 -->

        @foreach ($workspaces as $item)
           
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                <div class="h-10 {{$item->color}}">

                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <h3 class="text-lg font-semibold text-gray-800">{{$item->name}}</h3>
                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">0 Tableau</span>
                    </div>
                    <div class="mt-4 flex justify-between items-center">
                        <div class="flex -space-x-2">
                            <img src="https://ui-avatars.com/api/?name=Alice" alt="Membre" class="w-8 h-8 rounded-full border-2 border-white">
                            <img src="https://ui-avatars.com/api/?name=Bob" alt="Membre" class="w-8 h-8 rounded-full border-2 border-white">
                            <div class="w-8 h-8 rounded-full bg-gray-200 border-2 border-white flex items-center justify-center text-xs text-gray-600">+3</div>
                        </div>
                        <a href="/my-workspace/{{$item->id}}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Ouvrir</a>
                    </div>
                </div>
                <div class="h-10 {{$item->color}}">

                </div>
            </div>
 
        @endforeach



        
        {{-- <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
            <div class="h-10 bg-red-600">

            </div>
            <div class="p-6">
                <div class="flex justify-between items-start">
                    <h3 class="text-lg font-semibold text-gray-800">Projet Marketing</h3>
                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">2 Tableau</span>
                </div>
                <div class="mt-4 flex justify-between items-center">
                    <div class="flex -space-x-2">
                        <img src="https://ui-avatars.com/api/?name=Alice" alt="Membre" class="w-8 h-8 rounded-full border-2 border-white">
                        <img src="https://ui-avatars.com/api/?name=Bob" alt="Membre" class="w-8 h-8 rounded-full border-2 border-white">
                        <div class="w-8 h-8 rounded-full bg-gray-200 border-2 border-white flex items-center justify-center text-xs text-gray-600">+3</div>
                    </div>
                    <a href="#" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Ouvrir</a>
                </div>
            </div>
            <div class="h-10 bg-red-600">

            </div>
        </div> --}}

    </div>
</main>



    
@endsection
