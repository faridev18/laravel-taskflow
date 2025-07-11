<?php
namespace App\Http\Controllers;

use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    //
    public function pricing()
    {
        $subscription = Subscription::where("user_id", auth()->user()->id)
            ->where('status', 'active')
            ->latest()
            ->first();

        $currentPlan = $subscription ? $subscription->plan : 'freemium';

        return view("princing", compact("currentPlan"));
    }

    public function subscribe($plan)
    {
        session()->put('selected_plan', $plan);

        $plans = [
            'freemium' => [
                'title'      => 'Freemium',
                'price'      => 0,
                'workspaces' => 1,
                'features'   => ['Accès de base'],
            ],
            'premium'  => [
                'title'      => 'Premium',
                'price'      => 10000,
                'workspaces' => 5,
                'features'   => ['Fonctionnalités avancées'],
            ],
            'business' => [
                'title'      => 'Business',
                'price'      => 20000,
                'workspaces' => 'Illimité',
                'features'   => ['Statistiques détaillées', 'Support prioritaire'],
            ],
        ];

        return view('subscribe', [
            'planKey' => $plan,
            'plan'    => $plans[$plan],
        ]);

    }

    public function callback(Request $request)
    {
        $user          = auth()->user();
        $transactionId = $request->input('transaction_id');
        $plan          = session('selected_plan'); // Par défaut

        Subscription::create([
            'user_id'         => $user->id,
            'stripe_id'       => $transactionId,
            'plan'            => $plan,
            'status'          => 'active',
            'date_expiration' => Carbon::now()->addMonth(), // expire dans 1 mois
        ]);

        return redirect()->route('pricing')->with('success', 'Abonnement activé avec succès.');

    }
}
