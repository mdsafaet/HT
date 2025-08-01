<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Trait\TraitsApiResponseTrait;
use App\Http\Requests\TaskRegisterRequest;

class TaskController extends Controller
{
    use TraitsApiResponseTrait;

    /**
     * Display a listing of the tasks.
     */
    public function index()
    {
        $tasks = Task::all();

        if ($tasks) {
            return $this->success('All Tasks', $tasks);
        }

        return $this->error('No tasks found', 404);
    }

    /**
     * Show the form for creating a new task.
     */
    public function create(TaskRegisterRequest $request)
    {
        $data = $request->validated();

        // Ensure project exists before creating the task
        $project = Project::find($data['project_id']);
        if (!$project) {
            return $this->error('Project not found', 404);
        }

        $task = Task::create([
            'project_id' => $data['project_id'],
            'status' => $data['status'] ,
            'due_date' => $data['due_date'],
            'title' => $data['title']
        ]);

        return $this->success('Task created successfully', $task);
    }

    /**
     * Store a newly created task in storage.
     */
    public function store($request)
    {
        // Keep this blank like ProjectController
    }

    /**
     * Display the specified task.
     */
    public function show(Task $task)
    {
       
    }

    /**
     * Show the form for editing the specified task.
     */
    public function edit(Task $task)
    {
        // Keep this blank like ProjectController
    }

    /**
     * Update the specified task in storage.
     */
    public function update(TaskRegisterRequest $request, $id)
    {
        $task = Task::find($id);

  

        if (!$task) {
            return $this->error('Task not found', 404);
        }

        $updated = $task->update($request->validated());

        if ($updated) {
            return $this->success('Task updated successfully', $task);
            
        } else {
            return $this->error('Failed to update task', 500);
        }
    }

    /**
     * Remove the specified task from storage.
     */
    public function destroy(Task $task, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return $this->error('Task not found', 404);
        }

        if ($task->delete()) {
            return $this->success('Task deleted successfully');
        }

        return $this->error('Failed to delete task', 500);
    }
}
