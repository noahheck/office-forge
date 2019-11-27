<?php

namespace App\Http\Controllers;

use App\Jobs\Project\Create;
use App\Jobs\Project\Update;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Requests\Project\Store as StoreRequest;
use App\Http\Requests\Project\Update as UpdateRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $projects = Project::orderBy('active', 'DESC')->orderBy('due_date')->orderBy('completed', 'ASC')->get();

        return $this->view('projects.index', [
            'projects' => $projects,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $project = new Project();
        $project->due_date = now();
        $project->owner_id = $request->user()->id;

        return $this->view('projects.create', [
            'project' => $project,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $this->dispatchNow($projectCreated = new Create(
            $request->name,
            $request->due_date,
            $request->details,
            $request->user()
        ));

        $project = $projectCreated->getProject();

        return redirect()->route('projects.show', [$project]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return $this->view('projects.show', [
            'project' => $project,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return $this->view('projects.edit', [
            'project' => $project,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Project $project)
    {
        $this->dispatchNow($projectUpdated = new Update(
            $project,
            $request->name,
            $request->due_date,
            $request->details
        ));

        return redirect()->route('projects.show', [$project]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
