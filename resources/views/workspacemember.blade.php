@extends('layouts.app')

@section('content')
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header avec bouton -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Membres du Workspace</h1>
                <p class="text-gray-500 mt-1">Gérez les accès et permissions</p>
            </div>
            <button
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6z" />
                </svg>
                Inviter
            </button>
        </div>

        <!-- Liste des membres -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- En-tête du tableau -->
            <div class="grid grid-cols-12 gap-4 px-6 py-3 bg-gray-50 border-b border-gray-200">
                <div class="col-span-4 text-sm font-medium text-gray-500">Membre</div>
                <div class="col-span-3 text-sm font-medium text-gray-500">Rôle</div>
                <div class="col-span-3 text-sm font-medium text-gray-500">Date</div>
                <div class="col-span-2 text-right text-sm font-medium text-gray-500">Actions</div>
            </div>

            <!-- Membre 1 -->

            @foreach ($workspace->users as $item)
                <div class="grid grid-cols-12 gap-4 px-6 py-4 border-b border-gray-100 hover:bg-gray-50 transition-colors">
                    <div class="col-span-4 flex items-center">
                        <img src="https://i.pravatar.cc/40?img={{ $item->id }}" alt="Avatar"
                            class="h-10 w-10 rounded-full mr-3">
                        <div>
                            <p class="font-medium text-gray-900">{{ $item->name }}</p>
                            <p class="text-sm text-gray-500">{{ $item->email }}</p>
                        </div>
                    </div>
                    <div class="col-span-3 flex items-center">
                        <span
                            class="px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">{{ $item->pivot->role }}</span>
                    </div>
                    <div class="col-span-3 flex items-center text-sm text-gray-500">
                        {{ $item->pivot->created_at }}
                    </div>
                    <div class="col-span-2 flex justify-end items-center">
                         <a onclick="return confirm('Êtes-vous sûr de vouloir retirer ce membre ?')" 
                           href="{{ route('workspace.removeMember', ['workspace' => $workspace->id, 'user' => $item->id]) }}"
                           class="text-red-600 hover:text-red-800">
                            <i class="fas fa-user-minus mr-1"></i> Retirer
                        </a>
                    </div>
                </div>
            @endforeach


        </div>


        <div class="mt-10">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Ajouter un membre</h1>
            </div>
            <form action="{{ route('savemember') }}" method="POST">

                @if (session('success'))
                    <div class=" text-green-500 mt-2">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="text-red-500 mt-2">{{ session('error') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li class="text-red-500 mt-2">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                @csrf


                <input name="workspace_id" value="{{ request()->id }}" type="hidden">

                <!-- Champ Nom -->
                <div class="mb-6 mt-3">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror"
                        placeholder="test@gmail.com " value="{{ old('email') }}">
                    {{-- Message d'erreur --}}
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6 mt-3">
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Role</label>

                    <select
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror"
                        name="role" id="role">
                        <option value="admin">Admin</option>
                        <option value="membre">Membre</option>
                    </select>


                    @error('role')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>


                <!-- Boutons d'action -->
                <div class="flex justify-end space-x-4">

                    <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
                        Ajouter le membre
                    </button>
                </div>
            </form>
        </div>

        <!-- Pied de page -->
        <div class="mt-6 flex justify-between items-center text-sm text-gray-500">
            <div>3 membres actifs</div>
            <div>2 invitations en attente</div>
        </div>
    </main>
@endsection
