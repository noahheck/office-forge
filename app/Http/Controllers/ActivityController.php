<?php

namespace App\Http\Controllers;

use App\Jobs\Activity\Create;
use App\Jobs\Activity\Update;
use App\Activity;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\Activity\Store as StoreRequest;
use App\Http\Requests\Activity\Update as UpdateRequest;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $activities = Activity::orderBy('active', 'DESC')->orderBy('due_date')->orderBy('completed', 'ASC')->get();

        return $this->view('activities.index', compact('activities'));

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

        $users = User::orderBy('active', 'DESC')->orderBy('name')->get();

        return $this->view('activities.create', compact('activity', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $this->dispatchNow($activityCreated = new Create(
            $request->name,
            $request->due_date,
            $request->owner_id,
            $request->details,
            $request->user(),
            $request->temp_id
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
    public function show(Activity $activity)
    {
        return $this->view('activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        $users = User::orderBy('active', 'DESC')->orderBy('name')->get();

        return $this->view('activities.edit', compact('activity', 'users'));
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
        $this->dispatchNow($activityUpdated = new Update(
            $activity,
            $request->name,
            $request->due_date,
            $request->owner_id,
            $request->has('completed'),
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
    public function destroy(Activity $activity)
    {
        //
    }
}
