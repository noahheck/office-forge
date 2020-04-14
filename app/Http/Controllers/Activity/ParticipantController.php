<?php

namespace App\Http\Controllers\Activity;

use App\Activity;
use App\Http\Controllers\Controller;
use App\Jobs\Activity\Participants\Update;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\Activity\Participant\Update as UpdateRequest;
use function App\flash_error;
use function App\flash_success;

class ParticipantController extends Controller
{
    public function show(Request $request, Activity $activity)
    {
        $participants = $activity->participants;

        if ($participants->count() < 1) {

            return redirect()->route('activities.participants.edit', [$activity]);
        }

        $participants->load('user');

        return $this->view('activities.participants.index', compact('activity', 'participants'));
    }

    public function edit(Request $request, Activity $activity)
    {
        if (!$request->user()->can('update', $activity)) {
            flash_error(__('activity.error_unableToEditActivity'));

            return redirect()->route('activities.show', $activity);
        }

        $participants = $activity->participants;

        $participants->load('user');

        $userOptions = User::ordered()->get();

        return $this->view('activities.participants.edit', compact(
            'activity',
            'participants',
            'userOptions'
        ));
    }

    public function update(UpdateRequest $request, Activity $activity)
    {
        if (!$request->user()->can('update', $activity)) {
            flash_error(__('activity.error_unableToEditActivity'));

            return redirect()->route('activities.show', $activity);
        }

        $this->dispatchNow($participantsUpdated = new Update($activity, $request->participants, $request->user()));

        flash_success(__('activity.participantsUpdated'));

        if ($return = $request->return) {

            return redirect($return);
        }

        return redirect()->route('activities.show', [$activity]);
    }
}
