<?php

namespace App\Http\Controllers\Activity;

use App\Activity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function show(Request $request, Activity $activity)
    {
        $participants = $activity->participants;

        /*if ($participants->count() < 1) {

            return redirect()->route('activities.participants.edit', [$activity]);
        }*/

        $participants->load('users');

        return $this->view('activities.participants.index', compact('activity', 'participants'));
    }

    public function edit(Request $request, Activity $activity)
    {

    }

    public function update(Request $request, Activity $activity)
    {

    }
}
