<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param TaskRequest $request
     * @param Project $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TaskRequest $request, Project $project)
    {
        if (!$project->tasks()->create($request->validated())) {
            return redirect()->back()->with('error', 'An unexpected error occurred, while creating the task!');
        }

        return redirect()->back()->with('success', 'Task created!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Task $task)
    {
        if (!$task->update(['is_done' => $request->input('is_done', false)])) {
            return redirect()->back()->with('error', 'An unexpected error occurred while completing the task!');
        }

        return redirect()->back()->with('success', 'Task completed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Task $task)
    {
        if (!$task->delete()) {
            return redirect()->back()->with('error', 'An unexpected error occurred while deleting the task!');
        }

        return redirect()->back()->with('success', 'Task deleted!');
    }
}
