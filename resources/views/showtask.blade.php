@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- En-tête -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Tâches du Tableau</h1>
            <a href="/newtask/{{ request()->id }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                <i class="fas fa-plus"></i>
                Nouvelle Tâche
            </a>
        </div>

        <!-- Filtres -->
        <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
            <div class="flex flex-wrap gap-4">
                <select class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option>Toutes les tâches</option>
                    <option>À faire</option>
                    <option>En cours</option>
                    <option>Terminées</option>
                </select>
                <select class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option>Tous les membres</option>
                    <option>Assigné à moi</option>
                </select>
                <input type="date"
                    class="border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
        </div>

        @php
            $states = [
                'todo' => ['label' => 'À faire', 'color' => 'red'],
                'in_progess' => ['label' => 'En cours', 'color' => 'yellow'],
                'blocked' => ['label' => 'Bloqué', 'color' => 'gray'],
                'done' => ['label' => 'Terminé', 'color' => 'green'],
            ];
        @endphp

        <div x-data="{ open: false, currentTask: null }" x-cloak class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($states as $key => $state)
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h2 class="font-semibold text-lg mb-4 flex items-center">
                        <span class="w-3 h-3 bg-{{ $state['color'] }}-500 rounded-full mr-2"></span>
                        {{ $state['label'] }}
                    </h2>

                    @forelse($tasks[$key] ?? [] as $task)
                        <div class="bg-white p-4 rounded-lg shadow-sm mb-4 border-l-4 border-{{ $state['color'] }}-500">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-medium">{{ $task->title }}</h3>

                                @if ($task->user_id == auth()->id() || $board->workspace->owner->id == auth()->id())
                                    <div class="flex space-x-2">
                                        <button @click="open = true; currentTask = {{ json_encode($task) }}"
                                            class="text-gray-400 hover:text-gray-600">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        <a onclick="confirm('Voulez vous supprimer cette tache ?')"
                                            href="/delete-task/{{ $task->id }}"
                                            class="text-gray-400 hover:text-gray-600">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                @endif



                            </div>
                            <p class="text-gray-600 text-sm mb-3">{{ $task->description }}</p>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-500">
                                    @if ($task->state === 'done')
                                        Terminé le:
                                        {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('d/m/Y') : 'N/A' }}
                                    @else
                                        Échéance:
                                        {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('d/m/Y') : 'N/A' }}
                                    @endif
                                </span>
                                <div class="flex items-center">
                                    @if ($task->assignedUser)
                                        <img src="https://i.pravatar.cc/24?u={{ $task->assignedUser->email }}"
                                            class="w-6 h-6 rounded-full mr-1">
                                        <span>{{ $task->assignedUser->name }}</span>
                                    @else
                                        <span class="text-gray-500">Non assigné</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm italic">Aucune tâche</p>
                    @endforelse
                </div>
            @endforeach

            {{-- Modal --}}

            <div x-show="open" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
                <div @click.away="open = false" class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4"
                            x-text="'Modifier: ' + (currentTask ? currentTask.title : '')"></h3>

                        <form x-bind:action="'/update-tasks/' + (currentTask ? currentTask.id : '')" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="title" class="block text-sm font-medium text-gray-700">Titre</label>
                                <input type="text" id="title" name="title" x-model="currentTask.title"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>

                            <div class="mb-4">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea id="description" name="description" rows="3" x-model="currentTask.description"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="deadline" class="block text-sm font-medium text-gray-700">Échéance</label>
                                    <input type="date" id="deadline" name="deadline" x-model="currentTask.deadline"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                                <div>
                                    <label for="state" class="block text-sm font-medium text-gray-700">Statut</label>
                                    <select id="state" name="state" x-model="currentTask.state"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                        @foreach ($states as $key => $state)
                                            <option value="{{ $key }}">{{ $state['label'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="assigned_to" class="block text-sm font-medium text-gray-700">Assigné à</label>
                                <select id="assigned_to" name="assigned_to" x-model="currentTask.assigned_to"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Non assigné</option>
                                    @foreach ($board->workspace->users as $member)
                                        <option value="{{ $member->id }}">{{ $member->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex justify-end space-x-3 pt-2">
                                <button type="button" @click="open = false"
                                    class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Annuler
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700">
                                    Enregistrer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>






        </div>

    </div>



    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
