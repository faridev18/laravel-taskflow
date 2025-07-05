<?php
namespace App\Http\Controllers;

use App\Mail\NotifyUserMail;
use App\Models\User;
use App\Models\Workspace;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class WorkspaceController extends Controller
{
    //

    public function myworkspace()
    {

        $workspaces = Workspace::where('owner_id', auth()->user()->id)->get();

        $invitedworkspaces = auth()->user()->workspaces()
            ->where("owner_id", "!=", auth()->id())
            ->with("owner")
            ->get();

        return view("myworkspace")->with("workspaces", $workspaces)->with("invitedworkspaces", $invitedworkspaces);

    }

    public function createworkspace()
    {

        $workspacesNumber = Workspace::where('owner_id', auth()->user()->id)->count();

        $subscription = Subscription::where("user_id", auth()->user()->id)
                                ->where('status', 'active')
                                ->latest()
                                ->first();

        $plan = $subscription ? $subscription->plan : 'freemium';


        $limits =[
            "freemium" => 1,
            "premium" => 5,
            "business" => PHP_INT_MAX
        ];

        $max = $limits[$plan] ?? 1;


        if($workspacesNumber >= $max){
             return redirect()->route('my-workspace')
                         ->with('error', "Vous avez atteint la limite de votre plan ($plan). Veuillez mettre à niveau pour créer plus de workspaces.");
        }


        return view("createworkspace")->with("workspacesNumber", $workspacesNumber);
    }

    public function saveworkspace(Request $request)
    {

        $request->validate([
            'name'  => 'required',
            'color' => 'required',

        ], [
            'name.required'  => 'Le nom est obligatoire.',
            'color.required' => 'La couleur est obligatoire.',
        ]);

        $workspace = Workspace::create([
            "name"     => $request->name,
            "owner_id" => auth()->user()->id,
            "color"    => $request->color,
        ]);

        return redirect('/my-workspace');

    }

    public function workspacemember($id)
    {

        $workspace = Workspace::with("users")->findOrFail($id);
        return view("workspacemember")->with("workspace", $workspace);
    }

    public function savemember(Request $request)
    {
        $request->validate(
            [
                "email" => "required|email|exists:users,email",
                "role"  => "required|in:admin,membre",
            ]
        );

        $user      = User::where("email", $request->email)->first();
        $workspace = Workspace::findOrFail($request->workspace_id);

        if ($workspace->users()->where('user_id', $user->id)->exists()) {
            return back()->withErrors("Cet utilisateur est déja membre de cet workspace");
        }

        $workspace->users()->attach($user->id, ["role" => $request->role]);

        // Envoie un mail

        Mail::to($user->email)->send(new NotifyUserMail($user, $workspace, $request->role));

        return back()->with('success', 'Membre ajouté avec succès.');

    }

    public function removeMember(Workspace $workspace, User $user)
    {

        $workspace->users()->detach($user->id);
        return back()->with('success', 'Membre retiré avec succès.');

    }

}
