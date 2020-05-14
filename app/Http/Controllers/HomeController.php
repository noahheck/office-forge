<?php

namespace App\Http\Controllers;

use App\Activity\ActivityProvider;
use App\Document\DocumentProvider;
use App\FormDoc\Template\TemplateProvider;
use App\Process\ProcessProvider;
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
     * @return \Illuminate\Http\Response
     */
    public function index(
        Request $request,
        ActivityProvider $activityProvider,
        DocumentProvider $documentProvider,
        TemplateProvider $templateProvider,
        ProcessProvider $processProvider
    ) {
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

        $processOptions = $processProvider->getProcessesCreatableByUser($user);

        $templates = $templateProvider->getTemplatesCreatableByUser($user);

        $myFiles = $user->myFiles;

        $myFiles->load('headshots', 'fileType');

        return $this->view('home', compact(
            'activities',
            'user',
            'processOptions',
            'myFiles',
            'myWork',
            'templates'
        ));
    }
}
