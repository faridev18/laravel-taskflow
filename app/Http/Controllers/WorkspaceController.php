<?php
namespace App\Http\Controllers;

use App\Models\Workspace;
use Illuminate\Http\Request;

class WorkspaceController extends Controller
{
    //

    public function myworkspace()
    {

        $workspaces = Workspace::where('owner_id', auth()->user()->id)->get();
        return view("myworkspace")->with("workspaces", $workspaces);

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

}
