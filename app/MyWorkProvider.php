<?php


namespace App;


use App\Activity\ActivityProvider;
use App\Document\DocumentProvider;

class MyWorkProvider
{
    private $activityProvider;
    private $documentProvider;

    public function __construct(ActivityProvider $activityProvider, DocumentProvider $documentProvider)
    {
        $this->activityProvider = $activityProvider;
        $this->documentProvider = $documentProvider;
    }

    public function getMyWork(User $user)
    {
        $activities = $this->activityProvider->getOpenActivitiesForUser($user);

        $activities->load('tasks', 'owner', 'owner.headshots', 'formDocs');

        $documents = $this->documentProvider->getOpenDocumentsForUser($user);

        $documents->load('file', 'file.headshots');

        $myWork = $activities->concat($documents)->sortBy(function($workItem, $key) {

            $workItemKey = $workItem::WORK_ITEM_KEY;
            switch ($workItemKey):

                case ('activity'):

                    $due_date = optional($workItem->earliestOpenTaskWithDueDate())->due_date;

                    if (!$due_date || ($workItem->due_date && $due_date > $workItem->due_date)) {

                        $due_date = $workItem->due_date;
                    }

                    if (!$due_date) {

                        $due_date = $workItem->created_at->addCenturies(1);
                    }

                    return $due_date;
                    break;

                case ('form-doc'):
                    return $workItem->created_at;
                    break;

            endswitch;

            return 0;
        });

        return $myWork;
    }
}
