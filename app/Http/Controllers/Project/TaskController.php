<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Activity\Task\Store as StoreRequest;
use App\Http\Requests\Activity\Task\Update as UpdateRequest;
use App\Jobs\Activity\Task\Create;
use App\Jobs\Activity\Task\Update;
use App\Project;
use App\Project\Task;
use App\User;
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
    public function create(Request $request, Project $project)
    {
        $task = new Task;
        $task->project_id = $project->id;
        $task->assigned_to = $request->user()->id;

        $users = User::orderBy('active', 'DESC')->orderBy('name')->get();

        return $this->view('projects.tasks.create', compact('task', 'project', 'users'));
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
            $request->assigned_to,
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
        $users = User::orderBy('active', 'DESC')->orderBy('name')->get();

        return $this->view('projects.tasks.edit', compact('task', 'project', 'users'));
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
            $request->assigned_to,
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
