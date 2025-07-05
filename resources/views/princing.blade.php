@extends('layouts.app')

@section('content')
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h2 class="text-2xl font-bold text-gray-800 mb-2">Obtenez plus de Workspaces</h2>
    <p class="text-gray-600 mb-6">Choisissez un plan selon vos besoins.</p>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @php
        $plans = [
            'freemium' => ['title' => 'Freemium', 'desc' => 'Idéal pour les utilisateurs individuels', 'workspaces' => 1, 'features' => ['Accès de base', 'Gratuit'], 'price' => '0€'],
            'premium' => ['title' => 'Premium', 'desc' => 'Parfait pour les petites équipes', 'workspaces' => 5, 'features' => ['Fonctionnalités avancées'], 'price' => '9,99 €/mois'],
            'business' => ['title' => 'Business', 'desc' => 'Pour les entreprises ambitieuses', 'workspaces' => 'Illimité', 'features' => ['Statistiques', 'Support prioritaire'], 'price' => '29,99 €/mois'],
        ];

        $levels = ['freemium' => 0, 'premium' => 1, 'business' => 2];
        $userLevel = $levels[$currentPlan];
    @endphp

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($plans as $key => $plan)
            @php
                $planLevel = $levels[$key];
                $isCurrent = $key === $currentPlan;
                $isHigher = $planLevel > $userLevel;
                $isLower = $planLevel < $userLevel;
            @endphp

            <div class="border rounded-lg p-6 shadow-sm bg-white relative">
                @if($isCurrent)
                    <span class="absolute top-0 right-0 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-bl">Plan actif</span>
                @endif

                <h3 class="text-xl font-semibold {{ $isCurrent ? 'text-green-600' : 'text-gray-800' }} mb-2">{{ $plan['title'] }}</h3>
                <p class="text-gray-600 mb-4">{{ $plan['desc'] }}</p>
                <ul class="text-sm text-gray-700 mb-4 space-y-1">
                    <li>✅ {{ $plan['workspaces'] }} Workspaces</li>
                    @foreach($plan['features'] as $feature)
                        <li>🔹 {{ $feature }}</li>
                    @endforeach
                    <li>💳 {{ $plan['price'] }}</li>
                </ul>

                <a href="{{ $isHigher ? route('subscribe', ['plan' => $key]) : '#' }}"
                   class="inline-block w-full text-center {{ $isCurrent ? 'bg-gray-300 text-gray-600 cursor-not-allowed' : ($isHigher ? 'bg-indigo-600 text-white hover:bg-indigo-700' : 'bg-gray-200 text-gray-400 cursor-not-allowed') }} px-4 py-2 rounded transition"
                   {{ $isCurrent || $isLower ? 'onclick=event.preventDefault()' : '' }}>
                    {{ $isCurrent ? 'Plan Actif' : ($isHigher ? 'Passer à ' . $plan['title'] : 'Indisponible') }}
                </a>
            </div>
        @endforeach
    </div>
</main>
@endsection
