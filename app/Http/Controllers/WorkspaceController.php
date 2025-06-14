<?php
namespace App\Http\Controllers;

use App\Models\Workspace;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyUserMail;


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
        return view("createworkspace");
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

        Mail::to($user->email)->send(new NotifyUserMail($user,$workspace,$request->role));

        return back()->with('success', 'Membre ajouté avec succès.');

    }

}
