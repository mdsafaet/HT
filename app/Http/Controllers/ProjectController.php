<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRegisterRequest;
use App\Models\Project;
use App\Trait\TraitsApiResponseTrait;
use Illuminate\Http\Request;

use App\Traits\ApiResponseTrait;

class ProjectController extends Controller
{
    use TraitsApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

 

    $project->users()->attach($data['user_id']);

    return $this->success($project);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

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
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
