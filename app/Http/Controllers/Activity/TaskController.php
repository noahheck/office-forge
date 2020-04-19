<?php

namespace App\Http\Controllers\Activity;

use App\Activity;
use App\Http\Controllers\Controller;
use App\Http\Requests\Activity\Task\Store as StoreRequest;
use App\Http\Requests\Activity\Task\Update as UpdateRequest;
use App\Jobs\Activity\Task\Complete;
use App\Jobs\Activity\Task\Create;
use App\Jobs\Activity\Task\Uncomplete;
use App\Jobs\Activity\Task\Update;
use App\Activity\Task;
use App\User;
use Illuminate\Http\Request;
use function App\flash_error;
use function App\flash_success;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Activity $activity)
    {
        if (!$request->user()->can('view', $activity)) {
            flash_error(__('activity.error_unableToAccessActivity'));

            return redirect()->route('home');
        }

        return $this->view('activities.tasks.index', compact('activity'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Activity $activity)
    {
        if (!$request->user()->can('create', [Task::class, $activity])) {
            flash_error(__('activity.error_unableToAccessActivity'));

            return redirect()->route('home');
        }

        $task = new Task;
        $task->project_id = $activity->id;
        $task->assigned_to = $request->user()->id;

        $users = $activity->participantUsers()->push($activity->owner)->unique();

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
        if (!$request->user()->can('create', [Task::class, $activity])) {
            flash_error(__('activity.error_unableToAccessActivity'));

            return redirect()->route('home');
        }

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
    public function show(Request $request, Activity $activity, Task $task)
    {
        if (!$request->user()->can('view', $activity)) {
            flash_error(__('activity.error_unableToAccessActivity'));

            return redirect()->route('home');
        }

        return $this->view('activities.tasks.show', compact('task', 'activity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Activity\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Activity $activity, Task $task)
    {
        if (!$request->user()->can('update', $task)) {
            flash_error(__('activity.error_unableToAccessActivity'));

            return redirect()->route('home');
        }

        $users = $activity->participantUsers()->push($activity->owner)->unique();

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
        if (!$request->user()->can('update', $task)) {
            flash_error(__('activity.error_unableToAccessActivity'));

            return redirect()->route('home');
        }

        $this->dispatchNow($taskUpdated = new Update(
            $task,
            $request->title,
            $request->due_date,
            $request->assigned_to,
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


    public function complete(Request $request, Activity $activity, Task $task)
    {
        if (!$request->user()->can('update', $task)) {
            flash_error(__('activity.error_unableToAccessActivity'));

            return redirect()->route('home');
        }

        $this->dispatchNow($taskCompleted = new Complete($task, $request->user()));

        flash_success(__('activity.taskUpdated'));

        return redirect()->route('activities.show', [$activity]);
    }

    public function uncomplete(Request $request, Activity $activity, Task $task)
    {
        if (!$request->user()->can('update', $task)) {
            flash_error(__('activity.error_unableToAccessActivity'));

            return redirect()->route('home');
        }

        $this->dispatchNow($taskUncompleted = new Uncomplete($task, $request->user()));

        flash_success(__('activity.taskUpdated'));

        return redirect()->route('activities.tasks.show', [$activity, $task]);
    }
}
