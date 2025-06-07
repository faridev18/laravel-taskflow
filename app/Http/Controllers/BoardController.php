<?php
namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Workspace;
use Illuminate\Http\Request;


class BoardController extends Controller
{
    //

    public function workspaceboads($id)
    {
        $workspace = Workspace::where("id", $id)->with('boards')->first();

    

        // $boards = Board::where('workspace_id',$id)->get();

        return view("workspaceboads")->with("workspace", $workspace);
    }

    public function createboard()
    {
        return view("createboard");

    }

    public function saveboard(Request $request)
    {

        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Le nom est obligatoire.',
        ]);

        $workspace = Board::create([
            "name"         => $request->name,
            "workspace_id" => $request->workspace_id,
        ]);

        return redirect('/my-workspace/'.$request->workspace_id);

    }
}
