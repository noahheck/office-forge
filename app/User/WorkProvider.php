<?php


namespace App\User;


use App\User;
use App\Activity\ActivityProvider;
use App\Document\DocumentProvider;

class WorkProvider
{
    private $activityProvider;
    private $documentProvider;

    public function __construct(ActivityProvider $activityProvider, DocumentProvider $documentProvider)
    {
        $this->activityProvider = $activityProvider;
        $this->documentProvider = $documentProvider;
    }

    public function getWorkForUser(User $user)
    {
        $activities = $this->activityProvider->getOpenActivitiesForUser($user);

        $activities->load('tasks', 'owner', 'owner.headshots', 'formDocs');

        $documents = $this->documentProvider->getOpenDocumentsForUser($user);

        $documents->load('file', 'file.headshots');

        $activities = $activities->sortBy(function($workItem, $key) {

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

            endswitch;

            return 0;
        });

        $overdueActivities = $activities->filter(function($activity) {
            return $activity->isOverdue();
        });

        $dueTodayActivities = $activities->filter(function($activity) {
            return $activity->isDueToday();
        });

        $myWork = [
            'inProgress' => $documents,
            'overDue' => $overdueActivities,
            'dueToday' => $dueTodayActivities,

        ];

        return $myWork;
    }
}
