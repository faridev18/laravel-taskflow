@extends('layouts.app')

@section('content')
<main class="max-w-3xl mx-auto px-4 py-10">
    <div class="bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Détail du plan choisi</h1>

        <div class="mb-6 border rounded-lg p-6">
            <h2 class="text-xl text-indigo-600 font-semibold">{{ $plan['title'] }}</h2>
            <p class="text-gray-700 mt-2"><strong>Prix :</strong> {{ $plan['price'] == 0 ? 'Gratuit' : number_format($plan['price'], 2) . ' € / mois' }}</p>
            <p class="text-gray-700"><strong>Workspaces :</strong> {{ $plan['workspaces'] }}</p>
            <p class="text-gray-700 mb-2"><strong>Fonctionnalités :</strong></p>
            <ul class="list-disc ml-6 text-gray-700">
                @foreach($plan['features'] as $feature)
                    <li>{{ $feature }}</li>
                @endforeach
            </ul>
        </div>

        <!-- Bouton de paiement -->
        <form action="" method="POST">
            @csrf
            <input type="hidden" name="plan" value="{{ $planKey }}">
            <button type="submit"
                class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition">
                {{ $plan['price'] == 0 ? 'Activer le plan gratuitement' : 'Payer maintenant' }}
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('pricing') }}" class="text-indigo-500 hover:underline">← Retour à la page des plans</a>
        </div>
    </div>
</main>
@endsection
