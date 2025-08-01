<?php

namespace App\Http\Controllers;

use App\Models\Project;

use App\Http\Controllers\Controller;

use App\Trait\TraitsApiResponseTrait;
use App\Http\Requests\ProjectRegisterRequest;

class ProjectController extends Controller
{
    use TraitsApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $project = Project::all();

        if ($project) {
            return $this->success('All Project', $project);
        }
        return $this->error();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ProjectRegisterRequest $request)
    {
        $data = $request->validated();

        $project = Project::create([
            'name' => $data['name'],
            'user_id' => $data['user_id']
        ]);


        return $this->success($project);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request) {}

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project) {}

    /**
     * Update the specified resource in storage.
     */
  public function update(ProjectRegisterRequest $request, $id)
    {
        $project = Project::find($id);

        if (!$project) {
            return $this->error('Project not found', 404);
        }

        $updated = $project->update($request->validated());

        if ($updated) {
            return $this->success($project);
        } else {
            return $this->error('Failed to update project', 500);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project, $id)
    {
        $project = Project::find($id);

        if (!$project) {
            return $this->error('Project not found', 404);
        }
    

        if ($project->delete()) {
            return $this->success('Project deleted successfully');
        }

        return $this->error('Failed to delete project', 500);
    }
}
