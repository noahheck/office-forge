<?php


namespace App\User;


use App\Activity\Task\TaskProvider;
use App\User;
use App\Activity\ActivityProvider;
use App\Document\DocumentProvider;

class WorkProvider
{
    private $activityProvider;
    private $documentProvider;
    private $taskProvider;

    public function __construct(
        ActivityProvider $activityProvider,
        DocumentProvider $documentProvider,
        TaskProvider $taskProvider
    ) {
        $this->activityProvider = $activityProvider;
        $this->documentProvider = $documentProvider;
        $this->taskProvider     = $taskProvider;
    }

    public function getWorkForUser(User $user)
    {
        $activities = $this->activityProvider->getOpenActivitiesForUser($user);

        $activities->load('tasks', 'owner', 'owner.headshots', 'formDocs');

        $documents = $this->documentProvider->getOpenDocumentsForUser($user);

        $documents->load('file', 'file.headshots');

        $tasks = $this->taskProvider->getOpenTasksForUser($user);

        $tasks->load('activity');

        $activities = $activities->sortBy(function($activity, $key) {

            $workItemKey = $activity::WORK_ITEM_KEY;
            switch ($workItemKey):

                case ('activity'):

                    $due_date = optional($activity->earliestOpenTaskWithDueDate())->due_date;

                    if (!$due_date || ($activity->due_date && $due_date > $activity->due_date)) {

                        $due_date = $activity->due_date;
                    }

                    if (!$due_date) {

                        $due_date = $activity->created_at->addCenturies(1);
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

        $dueThisWeekActivities = $activities->filter(function($activity) {
            return $activity->isDueThisWeek();
        })->reject(function($activity) use ($dueTodayActivities) {
            return $dueTodayActivities->contains($activity);
        })->reject(function($activity) use ($overdueActivities) {
            return $overdueActivities->contains($activity);
        });

        $overdueTasks = $tasks->filter(function($task) {
            return $task->isOverdue();
        });

        $dueTodayTasks = $tasks->filter(function($task) {
            return $task->isDueToday();
        });

        $dueThisWeekTasks = $tasks->filter(function($task) {
            return $task->isDueThisWeek();
        })->reject(function($task) use($dueTodayTasks) {
            return $dueTodayTasks->contains($task);
        })->reject(function($task) use($overdueTasks) {
            return $overdueTasks->contains($task);
        });

        $overdue = $overdueActivities->merge($overdueTasks)->sortBy('due_date');
        $dueToday = $dueTodayActivities->merge($dueTodayTasks)->sortBy('due_date');
        $dueThisWeek = $dueThisWeekActivities->merge($dueThisWeekTasks)->sortBy('due_date');

        $myWork = [
            'inProgress' => $documents,
            'overDue' => $overdue,
            'dueToday' => $dueToday,
            'dueThisWeek' => $dueThisWeek,
        ];

        return $myWork;
    }
}
