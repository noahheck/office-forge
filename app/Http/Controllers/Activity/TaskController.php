<?php

namespace App\Http\Controllers\Activity;

use App\Activity;
use App\Http\Controllers\Controller;
use App\Http\Requests\Activity\Task\Store as StoreRequest;
use App\Http\Requests\Activity\Task\Update as UpdateRequest;
use App\Jobs\Activity\Task\Create;
use App\Jobs\Activity\Task\Update;
use App\Activity\Task;
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
    public function index(Activity $activity)
    {
        return $this->view('activities.tasks.index', compact('activity'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Activity $activity)
    {
        $task = new Task;
        $task->project_id = $activity->id;
        $task->assigned_to = $request->user()->id;

        $users = User::orderBy('active', 'DESC')->orderBy('name')->get();

        return $this->view('activities.tasks.create', compact('task', 'activity', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request, Activity $activity)
    {
        $this->dispatchNow($taskCreated = new Create(
            $activity,
            $request->title,
            $request->due_date,
            $request->assigned_to,
            $request->details,
            $request->user(),
            $request->temp_id
        ));

        flash_success(__('activity.taskCreated'));

        return redirect()->route('activities.show', [$activity]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Activity\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity, Task $task)
    {
        return $this->view('activities.tasks.show', compact('task', 'activity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Activity\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity, Task $task)
    {
        $users = User::orderBy('active', 'DESC')->orderBy('name')->get();

        return $this->view('activities.tasks.edit', compact('task', 'activity', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activity\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Activity $activity, Task $task)
    {
        $this->dispatchNow($taskUpdated = new Update(
            $task,
            $request->title,
            $request->due_date,
            $request->assigned_to,
            $request->has('completed'),
            $request->details
        ));

        flash_success(__('activity.taskUpdated'));

        return redirect()->route('activities.show', [$activity]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activity\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity, Task $task)
    {
        //
    }
}
