<?php
namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\NotifyTaskMail;
use Illuminate\Support\Facades\Mail;


class TaskController extends Controller
{
    //
    public function showtask($id)
    {
        $board = Board::with(['tasks.assignedUser', 'workspace.owner', 'workspace.users'])->findOrFail($id);

        $tasks = $board->tasks->groupBy('state');

        return view("showtask")->with("tasks", $tasks)->with("board", $board);
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

      $task =  Task::create([
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'deadline'    => $validated['deadline'],
            'assigned_to' => $validated['assigned_to'],
            'board_id'    => $validated['board_id'],
            'user_id'     => auth()->id(),
        ]);

        $user= User::where("id", $validated['assigned_to'])->first();


         Mail::to($user->email)->send(new NotifyTaskMail($user, $task));



        return redirect()->route("showtask", ["id" => $validated['board_id']]);
    }

    public function deleteTask($id)
    {

        $task = Task::find($id);
        $task->delete();

        return back();
    }

    public function updateTask(Task $task, Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline'    => 'nullable|date',
            'state'       => 'required|in:todo,in_progress,blocked,done',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $task->update($validated);

        return back()->with('success', 'Tâche mise à jour avec succès');
    }

}
