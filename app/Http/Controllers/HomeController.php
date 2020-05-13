<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Activity\ActivityProvider;
use App\Document\DocumentProvider;
use App\FormDoc;
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
    public function index(Request $request, ActivityProvider $activityProvider, DocumentProvider $documentProvider)
    {
        $user = $request->user();

        $activities = $activityProvider->getOpenActivitiesForUser($user);

        $activities->load('tasks', 'owner', 'owner.headshots');

        $documents = $documentProvider->getOpenDocumentsForUser($user);

        $documents->load('file', 'file.headshots');

        $myWork = $activities->concat($documents)->sortBy(function($workItem, $key) {

            $workItemKey = $workItem::WORK_ITEM_KEY;
            switch ($workItemKey):

                case ('activity'):
                    return $workItem->due_date;
                    break;

                case ('form-doc'):
                    return $workItem->created_at;
                    break;

            endswitch;

            return 0;
        });

        $processOptions = Process::where('file_type_id', null)->get();

        $processOptions->load('creatingTeams');

        $processOptions = $processOptions->filter(function($process) use ($user) {

            return $process->canBeCreatedBy($user);
        });

        $myFiles = $user->myFiles;

        $myFiles->load('headshots', 'fileType');

        return $this->view('home', compact('activities', 'user', 'processOptions', 'myFiles', 'myWork'));
    }
}
