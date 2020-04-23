<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Activity\ActivityProvider;
use App\Process;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, ActivityProvider $activityProvider)
    {
        $user = $request->user();

        $activities = $activityProvider->getOpenActivitiesForUser($user);

        $activities->load('tasks', 'owner', 'owner.headshots');

        $processOptions = Process::where('file_type_id', null)->get();

        $processOptions->load('creatingTeams');

        $processOptions = $processOptions->filter(function($process) use ($user) {

            return $process->canBeCreatedBy($user);
        });

        $myFiles = $user->myFiles;

        $myFiles->load('headshots', 'fileType');

        return $this->view('home', compact('activities', 'user', 'processOptions', 'myFiles'));
    }
}
