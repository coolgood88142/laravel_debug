<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function destroy($task)
    {
        $task_to_be_deleted = Task::findOrFail($task);
        $task_to_be_deleted->delete();
        return response()->json([
            'message' => 'task deleted successfully'
        ], 410);
    }

    public function mark_task_as_completed(Task $task)
    {
        $task->mark_task_as_completed(); //calls the mark_task_as_complete method we created in the App/Models/Task.php file
        return response()->json([
            'message' => 'task successfully marked as updated'
        ], 200); //send a json response with the 200 status code
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create_task(Request $request)
    {
        DB::table('task')->insert([
            'name' => $request->name,
            'description' => $request->description,
            'completed' => random_int(0, 1)
        ]);

        return 'success';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }
}
