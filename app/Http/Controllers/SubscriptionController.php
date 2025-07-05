<?php
namespace App\Http\Controllers;

use App\Models\Subscription;
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
        $plans = [
            'freemium' => [
                'title'      => 'Freemium',
                'price'      => 0,
                'workspaces' => 1,
                'features'   => ['Accès de base'],
            ],
            'premium'  => [
                'title'      => 'Premium',
                'price'      => 9.99,
                'workspaces' => 5,
                'features'   => ['Fonctionnalités avancées'],
            ],
            'business' => [
                'title'      => 'Business',
                'price'      => 29.99,
                'workspaces' => 'Illimité',
                'features'   => ['Statistiques détaillées', 'Support prioritaire'],
            ],
        ];

        return view('subscribe', [
            'planKey' => $plan,
            'plan'    => $plans[$plan],
        ]);

    }
}
