<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    public function create(Request $request)
    {
        
        $todo = new Task();
        $todo->user_id = $request->input('user_id');
        $todo->task = $request->input('task');
        $todo->status = $request->input('status') ?? 'pending';
        $todo->save();
        return response()->json([
            "task" => $todo["task"],
            "status" => $todo["status"],
            "message" => "successfully created a task",
        ], 201);
    }

    public function update(Request $request, $user_id) {
        if (Task::where('user_id', $user_id)->exists()) {
            $task_status = Task::find($user_id); 
            $task_status->status=$request->status;
            $task_status->save();
    
            return response()->json([
                "message" => "Marked Task"
            ], 200);
            } else {
            return response()->json([
                "message" => "Task not found"
            ], 404);  
        }
    }

}
