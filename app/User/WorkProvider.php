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

    public function getOpenWorkForUser(User $user, $includeDueLater = false)
    {
        $activities = $this->activityProvider->getOpenActivitiesForUser($user);

        $activities->load('tasks', 'owner', 'owner.headshots', 'formDocs');

        $documents = $this->documentProvider->getOpenDocumentsForUser($user);

        $documents->load('file', 'file.headshots');

        $tasks = $this->taskProvider->getOpenTasksForUser($user);

        $tasks->load('activity');

        $tasks = $tasks->filter(function($task, $index) {
            return !$task->activity->completed;
        });

        $today = $user->today();



        [$overdueActivities, $activities] = $activities->partition(function($activity) {
            return $activity->isOverdue();
        });

        [$dueTodayActivities, $activities] = $activities->partition(function($activity) {
            return $activity->isDueToday();
        });

        [$dueThisWeekActivities, $activities] = $activities->partition(function($activity) {
            return $activity->isDueThisWeek();
        });

        $dueNextWeekActivities = collect([]);
        $dueLaterActivities = collect([]);

        if ($includeDueLater) {

            [$dueNextWeekActivities, $dueLaterActivities] = $activities->partition(function($activity) use ($today) {
                return $activity->due_date
                    && $activity->due_date->isNextWeek();
            });
        }



        [$overdueTasks, $tasks] = $tasks->partition(function($task) {
            return $task->isOverdue();
        });

        [$dueTodayTasks, $tasks] = $tasks->partition(function($task) {
            return $task->isDueToday();
        });

        [$dueThisWeekTasks, $tasks] = $tasks->partition(function($task) {
            return $task->isDueThisWeek();
        });

        $dueNextWeekTasks = collect([]);
        $dueLaterTasks = collect([]);

        if ($includeDueLater) {
            [$dueNextWeekTasks, $dueLaterTasks] = $tasks->partition(function($task) use ($today) {

                return $task->due_date
                    && $task->due_date->isNextWeek();
            });
        }



        $overdue = $this->sortOpenWork($overdueActivities->concat($overdueTasks)->sortBy('due_date'));
        $dueToday = $this->sortOpenWork($dueTodayActivities->concat($dueTodayTasks)->sortBy('due_date'));
        $dueThisWeek = $this->sortOpenWork($dueThisWeekActivities->concat($dueThisWeekTasks)->sortBy('due_date'));
        $dueNextWeek = $this->sortOpenWork($dueNextWeekActivities->concat($dueNextWeekTasks)->sortBy('due_date'));
        $dueLater = $this->sortOpenWork($dueLaterActivities->concat($dueLaterTasks)->sortBy('due_date'));

        $openWork = [
            'inProgress' => $documents,
            'overDue' => $overdue,
            'dueToday' => $dueToday,
            'dueThisWeek' => $dueThisWeek,
            'dueNextWeek' => $dueNextWeek,
            'dueLater' => $dueLater,
        ];

        return $openWork;
    }

    private function sortOpenWork($items)
    {
        return $items->sortBy(function($item) {
            return (is_null($item->due_date)) ? $item->created_at->addCenturies(1)->timestamp : $item->due_date->timestamp;
        });
    }



    public function getCompletedWorkForUser(User $user, $timeFrame = '')
    {
        $since = ($timeFrame) ? $user->timeAgo($timeFrame)->tz('UTC') : '';

        $activities = $this->activityProvider->getCompletedActivitiesForUser($user, $since);

        $activities->load('tasks', 'owner', 'owner.headshots', 'formDocs', 'file', 'file.fileType', 'file.headshots');

        $documents = $this->documentProvider->getCompletedDocumentsForUser($user, $since);

        $documents->load('file', 'file.fileType', 'file.headshots', 'activity', 'activity.file.headshots');

        $tasks = $this->taskProvider->getCompletedTasksForUser($user, $since);

        $tasks->load('activity', 'activity.file', 'activity.file.fileType', 'activity.file.headshots');

        $today = $user->today();



        [$completedTodayActivities, $activities] = $activities->partition(function($activity) use ($today) {
            return $activity->completed_at->clone()->tz($today->tz)->isSameDay($today);
        });

        [$completedThisWeekActivities, $activities] = $activities->partition(function($activity) use ($today) {
            return $activity->completed_at->clone()->tz($today->tz)->isSameWeek($today);
        });

        [$completedThisMonthActivities, $completedEarlierActivities] = $activities->partition(function($activity) use ($today) {
            return $activity->completed_at->clone()->tz($today->tz)->isSameMonth($today);
        });



        [$completedTodayDocuments, $documents] = $documents->partition(function($doc) use ($today) {
            return $doc->submitted_at->clone()->tz($today->tz)->isSameDay($today);
        });

        [$completedThisWeekDocuments, $documents] = $documents->partition(function($doc) use ($today) {
            return $doc->submitted_at->clone()->tz($today->tz)->isSameWeek($today);
        });

        [$completedThisMonthDocuments, $completedEarlierDocuments] = $documents->partition(function($doc) use ($today) {
            return $doc->submitted_at->clone()->tz($today->tz)->isSameMonth($today);
        });



        [$completedTodayTasks, $tasks] = $tasks->partition(function($task) use ($today) {
            return $task->completed_at->clone()->tz($today->tz)->isSameDay($today);
        });

        [$completedThisWeekTasks, $tasks] = $tasks->partition(function($task) use ($today) {
            return $task->completed_at->clone()->tz($today->tz)->isSameWeek($today);
        });

        [$completedThisMonthTasks, $completedEarlierTasks] = $tasks->partition(function($task) use ($today) {
            return $task->completed_at->clone()->tz($today->tz)->isSameMonth($today);
        });



        $completedToday = $this->sortCompletedWork(
            $completedTodayDocuments->concat($completedTodayActivities)->concat($completedTodayTasks)
        );

        $completedThisWeek = $this->sortCompletedWork(
            $completedThisWeekDocuments->concat($completedThisWeekActivities)->concat($completedThisWeekTasks)
        );

        $completedThisMonth = $this->sortCompletedWork(
            $completedThisMonthDocuments->concat($completedThisMonthActivities)->concat($completedThisMonthTasks)
        );

        $completedEarlier = $this->sortCompletedWork(
            $completedEarlierDocuments->concat($completedEarlierActivities)->concat($completedEarlierTasks)
        );



        $completedWork = [
            'completedToday' => $completedToday,
            'completedThisWeek' => $completedThisWeek,
            'completedThisMonth' => $completedThisMonth,
            'completedEarlier' => $completedEarlier,
        ];

        return $completedWork;
    }

    private function sortCompletedWork($items)
    {
        return $items->sortByDesc(function($item) {
            return ($item::WORK_ITEM_KEY === 'form-doc') ? $item->submitted_at->timestamp : $item->completed_at->timestamp;
        });
    }
}
