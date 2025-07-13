<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Admin</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="min-h-screen">
        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 w-64 bg-gray-800 text-white">
            <div class="p-4 border-b border-gray-700">
                <h1 class="text-2xl font-bold">Admin Dashboard</h1>
            </div>
            <nav class="p-4">
                <ul>
                    <li class="mb-2">
                        <a href="#" class="block px-4 py-2 bg-gray-700 rounded">Tableau de bord</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-700 rounded">Utilisateurs</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-700 rounded">Workspaces</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="block px-4 py-2 hover:bg-gray-700 rounded">Abonnements</a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main content -->
        <div class="ml-64 p-8">
            <h2 class="text-3xl font-bold mb-6">Tableau de bord</h2>

          <div class="py-3">
              
            <a href="{{ route('admin.export') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white w-fit px-4 py-2 rounded-lg flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                        Exporter en PDF
                    </a>
          </div>

            <!-- Stats cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-gray-500 text-sm font-medium">Utilisateurs</h3>
                    <p class="text-3xl font-bold">{{ $stats['users'] }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-gray-500 text-sm font-medium">Workspaces</h3>
                    <p class="text-3xl font-bold">{{ $stats['workspaces'] }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-gray-500 text-sm font-medium">Tableaux</h3>
                    <p class="text-3xl font-bold">{{ $stats['boards'] }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-gray-500 text-sm font-medium">Tâches</h3>
                    <p class="text-3xl font-bold">{{ $stats['tasks'] }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-gray-500 text-sm font-medium">Abonnements actifs</h3>
                    <p class="text-3xl font-bold">{{ $stats['active_subscriptions'] }}</p>
                </div>
            </div>

            <!-- Charts section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Task status chart -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold mb-4">Répartition des tâches par état</h3>
                    <div class="h-64">
                        <canvas id="taskStatusChart"></canvas>
                    </div>
                </div>

                <!-- Subscription plans chart -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold mb-4">Plans d'abonnement</h3>
                    <div class="h-64">
                        <canvas id="subscriptionPlansChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Recent users and workspaces -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent users -->
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold">Derniers utilisateurs</h3>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @foreach($recentUsers as $user)
                        <div class="p-4 flex items-center">
                            {{-- <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('images/default-avatar.png') }}" 
                                 alt="{{ $user->name }}" class="w-10 h-10 rounded-full mr-4"> --}}
                            <div>
                                <p class="font-medium">{{ $user->name }}</p>
                                <p class="text-sm text-gray-500">{{ $user->email }}</p>
                            </div>
                            <div class="ml-auto text-sm text-gray-500">
                                {{ $user->created_at->diffForHumans() }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Recent workspaces -->
                <div class="bg-white rounded-lg shadow">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold">Derniers workspaces</h3>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @foreach($recentWorkspaces as $workspace)
                        <div class="p-4">
                            <div class="flex items-center">
                                <div class="w-3 h-3 rounded-full mr-3 {{ $workspace->color }}" ></div>
                                <p class="font-medium">{{ $workspace->name }}</p>
                            </div>
                            <div class="flex justify-between mt-2 text-sm text-gray-500">
                                <span>Créé par: {{ $workspace->owner->name }}</span>
                                <span>{{ $workspace->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Task status chart
        const taskStatusCtx = document.getElementById('taskStatusChart').getContext('2d');
        const taskStatusChart = new Chart(taskStatusCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($taskStatusDistribution->keys()) !!},
                datasets: [{
                    data: {!! json_encode($taskStatusDistribution->values()) !!},
                    backgroundColor: [
                        '#3B82F6', // blue
                        '#10B981', // green
                        '#F59E0B', // yellow
                        '#EF4444', // red
                        '#8B5CF6', // purple
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                    }
                }
            }
        });

        // Subscription plans chart
        const subscriptionPlansCtx = document.getElementById('subscriptionPlansChart').getContext('2d');
        const subscriptionPlansChart = new Chart(subscriptionPlansCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($subscriptionPlans->keys()) !!},
                datasets: [{
                    label: 'Nombre d\'abonnements',
                    data: {!! json_encode($subscriptionPlans->values()) !!},
                    backgroundColor: '#3B82F6',
                    borderColor: '#2563EB',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>