<?php

namespace App\Http\Controllers;

use App\Activity\ActivityProvider;
use App\Activity\Task;
use App\File;
use App\Jobs\Activity\Complete;
use App\Jobs\Activity\Create;
use App\Jobs\Activity\Delete;
use App\Jobs\Activity\Tasks\UpdateOrder;
use App\Jobs\Activity\Uncomplete;
use App\Jobs\Activity\Update;
use App\Activity;
use App\Process;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\Activity\Store as StoreRequest;
use App\Http\Requests\Activity\Update as UpdateRequest;
use function App\flash_error;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ActivityProvider $activityProvider)
    {
        // Default behavior is to show the user their own open activities
        $showFilter = ($request->query('show')) ? $request->query('show') : 'open';

        switch ($showFilter):

            case 'open':
                $activities = $activityProvider->getOpenActivitiesForUser($request->user());

                break;

            case 'all':

                $activities = $activityProvider->getAllActivitiesForUser($request->user());

                break;

        endswitch;


        $activities->load('owner', 'tasks');

        return $this->view('activities.index', compact('activities', 'showFilter'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $activity = new Activity();
        $activity->due_date = now();
        $activity->owner_id = $request->user()->id;

        $file = ($fileId = $request->query('file_id')) ? File::find($fileId) : false;

        $activity->file_id = ($fileId) ? $fileId : null;

        $process = ($processId = $request->query('process_id')) ? Process::find($processId) : false;

        $activity->process_id = ($processId) ? $processId : null;

        if ($file && !$request->user()->can('view', $file)) {
            flash_error(__('file.error_unableToAccessFileType'));

            return redirect()->route('files.index');
        }

        if (!$request->user()->can('create', [Activity::class, $process])) {
            flash_error(__('activity.error_unableToCreateActivityOfType'));

            return redirect()->route('home');
        }

        $users = User::orderBy('active', 'DESC')->orderBy('name')->get();

        return $this->view('activities.create', compact('activity', 'users', 'file', 'process'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $process = ($processId = $request->process_id) ? Process::find($processId) : false;

        if (!$request->user()->can('create', [Activity::class, $process])) {
            flash_error(__('activity.error_unableToCreateActivityOfType'));

            return redirect()->route('home');
        }

        $this->dispatchNow($activityCreated = new Create(
            $request->name,
            $request->due_date,
            $request->owner_id,
            $request->has('private'),
            $request->details,
            $request->user(),
            $request->temp_id,
            $request->file_id ?? false,
            $request->process_id ?? false
        ));

        $activity = $activityCreated->getActivity();

        \App\flash_success(__('activity.activityCreated'));

        return redirect()->route('activities.show', [$activity]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Activity $activity)
    {
        $user = $request->user();

        $activity->load(
            'openTasks',
            'openTasks.assignedTo',
            'openTasks.assignedTo.headshots',
            'completedTasks',
            'completedTasks.assignedTo',
            'completedTasks.assignedTo.headshots',
            'completedTasks.completedBy',
            'completedTasks.completedBy.headshots',
            'participants',
            'participants.user',
            'participants.user.headshots'
        );

        if (!$user->can('view', $activity)) {
            flash_error(__('activity.error_unableToAccessActivity'));

            return redirect()->route('home');
        }

        $file = $activity->file;

        $participantRoute = ($user->can('update', $activity) && !$activity->completed) ?
            route('activities.participants.edit', [$activity]) :
            route('activities.participants.index', [$activity]);

        $newTask = new Task;
        $newTask->project_id = $activity->id;
        $newTask->assigned_to = $user->id;

        $taskUserOptions = $activity->participantUsers()->push($activity->owner)->unique();

        return $this->view('activities.show', compact('activity', 'file', 'participantRoute', 'newTask', 'taskUserOptions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Activity $activity)
    {
        if (!$request->user()->can('update', $activity)) {
            flash_error(__('activity.error_unableToEditActivity'));

            return redirect()->route('activities.show', $activity);
        }

        $users = User::orderBy('active', 'DESC')->orderBy('name')->get();

        $file = $activity->file;

        return $this->view('activities.edit', compact('activity', 'users', 'file'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activity  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Activity $activity)
    {
        if (!$request->user()->can('update', $activity)) {
            flash_error(__('activity.error_unableToEditActivity'));

            return redirect()->route('activities.show', $activity);
        }

        $this->dispatchNow($activityUpdated = new Update(
            $activity,
            $request->name,
            $request->due_date,
            $request->owner_id,
            $request->has('private'),
            $request->details
        ));

        \App\flash_success(__('activity.activityUpdated'));

        return redirect()->route('activities.show', [$activity]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Activity $activity)
    {
        if (!$request->user()->can('delete', $activity)) {
            flash_error(__('activity.error_unableToEditActivity'));

            return redirect()->route('activities.show', $activity);
        }

        $this->dispatchNow($activityDeleted = new Delete($activity, $request->user()));

        \App\flash_info(__('activity.activityDeleted'));

        return redirect()->route('home');
    }


    public function complete(Request $request, Activity $activity)
    {
        if (!$request->user()->can('update', $activity)) {
            flash_error(__('activity.error_unableToEditActivity'));

            return redirect()->route('activities.show', $activity);
        }

        $this->dispatchNow($activityCompleted = new Complete($activity, $request->user()));

        \App\flash_success(__('activity.activityUpdated'));

        return redirect()->route('activities.show', [$activity]);
    }

    public function uncomplete(Request $request, Activity $activity)
    {
        if (!$request->user()->can('update', $activity)) {
            flash_error(__('activity.error_unableToEditActivity'));

            return redirect()->route('activities.show', $activity);
        }

        $this->dispatchNow($activityCompleted = new Uncomplete($activity, $request->user()));

        \App\flash_success(__('activity.activityUpdated'));

        return redirect()->route('activities.show', [$activity]);
    }

    public function updateTasksOrder(Request $request, Activity $activity)
    {
        if (!$request->user()->can('update', $activity)) {
            flash_error(__('activity.error_unableToEditActivity'));

            return redirect()->route('activities.show', $activity);
        }

        $this->dispatchNow($taskOrderUpdated = new UpdateOrder($activity, $request->get('orderedTasks')));

        return $this->json(true, [
            'successMessage' => __('activity.activityUpdated'),
        ]);
    }
}
