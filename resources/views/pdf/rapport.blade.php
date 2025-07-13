<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rapport Admin</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .section { margin-bottom: 30px; }
        .section-title { 
            background-color: #f3f4f6; 
            padding: 8px; 
            font-weight: bold; 
            border-left: 4px solid #3b82f6;
            margin-bottom: 15px;
        }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        th { background-color: #f3f4f6; text-align: left; padding: 8px; }
        td { padding: 8px; border-bottom: 1px solid #e5e7eb; }
        .page-break { page-break-after: always; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Rapport Administratif</h1>
        <p>Généré le : {{ $generated_at }}</p>
    </div>

    <!-- Section Utilisateurs -->
    <div class="section">
        <div class="section-title">Utilisateurs ({{ $users->count() }})</div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Inscrit le</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Section Workspaces -->
    <div class="section">
        <div class="section-title">Workspaces ({{ $workspaces->count() }})</div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Propriétaire</th>
                    <th>Créé le</th>
                </tr>
            </thead>
            <tbody>
                @foreach($workspaces as $workspace)
                <tr>
                    <td>{{ $workspace->id }}</td>
                    <td>{{ $workspace->name }}</td>
                    <td>{{ $workspace->owner->name }}</td>
                    <td>{{ $workspace->created_at->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Section Tableaux -->
    <div class="section">
        <div class="section-title">Tableaux ({{ $boards->count() }})</div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Workspace</th>
                </tr>
            </thead>
            <tbody>
                @foreach($boards as $board)
                <tr>
                    <td>{{ $board->id }}</td>
                    <td>{{ $board->name }}</td>
                    <td>{{ $board->workspace->name }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Section Tâches -->
    <div class="section">
        <div class="section-title">Tâches ({{ $tasks->count() }})</div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Tableau</th>
                    <th>Assignée à</th>
                    <th>État</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->board->name }}</td>
                    <td>{{ $task->assignedUser ? $task->assignedUser->name : 'Non assignée' }}</td>
                    <td>
                        <span class="badge" style="background-color: 
                            @if($task->state == 'todo') #f59e0b 
                            @elseif($task->state == 'in_progress') #3b82f6 
                            @else #10b981 
                            @endif; color: white;">
                            {{ ucfirst(str_replace('_', ' ', $task->state)) }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Section Abonnements -->
    <div class="section">
        <div class="section-title">Abonnements ({{ $subscriptions->count() }})</div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Utilisateur</th>
                    <th>Plan</th>
                    <th>Statut</th>
                    <th>Expiration</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subscriptions as $subscription)
                <tr>
                    <td>{{ $subscription->id }}</td>
                    <td>{{ $subscription->user->name }}</td>
                    <td>{{ ucfirst($subscription->plan) }}</td>
                    <td>
                        <span class="badge" style="background-color: 
                            @if($subscription->status == 'active') #10b981 
                            @else #ef4444 
                            @endif; color: white;">
                            {{ ucfirst($subscription->status) }}
                        </span>
                    </td>
                    <td>{{ $subscription->date_expiration }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="text-right" style="margin-top: 30px;">
        <p>Rapport généré automatiquement par le système</p>
    </div>
</body>
</html>