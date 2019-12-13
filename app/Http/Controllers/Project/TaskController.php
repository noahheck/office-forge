<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\Task\Store as StoreRequest;
use App\Http\Requests\Project\Task\Update as UpdateRequest;
use App\Jobs\Project\Task\Create;
use App\Jobs\Project\Task\Update;
use App\Project;
use App\Project\Task;
use Illuminate\Http\Request;
use function App\flash_success;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Project $project)
    {
        return $this->view('projects.tasks.index', compact('project'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        $task = new Task;
        $task->project_id = $project->id;

        return $this->view('projects.tasks.create', compact('task', 'project'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, Project $project)
    {
        $this->dispatchNow($taskCreated = new Create(
            $project,
            $request->title,
            $request->due_date,
            $request->details,
            $request->user(),
            $request->temp_id
        ));

        flash_success(__('project.taskCreated'));

        return redirect()->route('projects.show', [$project]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, Task $task)
    {
        return $this->view('projects.tasks.show', compact('task', 'project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project, Task $task)
    {
        return $this->view('projects.tasks.edit', compact('task', 'project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Project $project, Task $task)
    {
        $this->dispatchNow($taskUpdated = new Update(
            $task,
            $request->title,
            $request->due_date,
            $request->has('completed'),
            $request->details
        ));

        flash_success(__('project.taskUpdated'));

        return redirect()->route('projects.show', [$project]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, Task $task)
    {
        //
    }
}
