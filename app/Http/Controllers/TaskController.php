<?php
namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function showtask($id)
    {
        $board = Board::with(['tasks.assignedUser'])->findOrFail($id);

        $tasks = $board->tasks->groupBy('state');

        return view("showtask")->with("tasks",$tasks);
    }

    public function newtask($id)
    {
        $board = Board::with("workspace.users")->find($id);
        // dd($board);
        return view("newtask")->with('board', $board);
    }

    public function savetask(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline'    => 'nullable|date',
            'assigned_to' => 'nullable|exists:users,id',
            'board_id'    => 'required|exists:boards,id',
        ]);

        Task::create([
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'deadline'    => $validated['deadline'],
            'assigned_to' => $validated['assigned_to'],
            'board_id'    => $validated['board_id'],
            'user_id'    => auth()->id(),
        ]);

        return redirect()->route("showtask", ["id" => $validated['board_id']]);
    }

}
