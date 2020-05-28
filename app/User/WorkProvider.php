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


        $overdueActivities = $activities->filter(function($activity) {
            return $activity->isOverdue();
        });

        $dueTodayActivities = $activities->filter(function($activity) {
            return $activity->isDueToday();
        });

        $dueThisWeekActivities = $activities->filter(function($activity) {

            return $activity->isDueThisWeek();
        })->reject(function($activity) use ($dueTodayActivities, $overdueActivities) {

            return $dueTodayActivities->contains($activity)
                || $overdueActivities->contains($activity);
        });

        $dueNextWeekActivities = collect([]);
        $dueLaterActivities = collect([]);

        if ($includeDueLater) {

            $dueNextWeekActivities = $activities->filter(function($activity) {

                return $activity->due_date && $activity->due_date->isNextWeek();
            });

            $dueLaterActivities = $activities->reject(function($activity) use (
                $overdueActivities,
                $dueTodayActivities,
                $dueThisWeekActivities,
                $dueNextWeekActivities
            ) {
                return $overdueActivities->contains($activity)
                    || $dueTodayActivities->contains($activity)
                    || $dueThisWeekActivities->contains($activity)
                    || $dueNextWeekActivities->contains($activity);
            });
        }


        $overdueTasks = $tasks->filter(function($task) {
            return $task->isOverdue();
        });

        $dueTodayTasks = $tasks->filter(function($task) {
            return $task->isDueToday();
        });

        $dueThisWeekTasks = $tasks->filter(function($task) {
            return $task->isDueThisWeek();
        })->reject(function($task) use($dueTodayTasks,$overdueTasks) {
            return $dueTodayTasks->contains($task)
                || $overdueTasks->contains($task);
        });

        $dueNextWeekTasks = collect([]);
        $dueLaterTasks = collect([]);

        if ($includeDueLater) {

            $dueNextWeekTasks = $tasks->filter(function($task) {
                return $task->due_date && $task->due_date->isNextWeek();
            });

            $dueLaterTasks = $tasks->reject(function($task) use (
                $overdueTasks,
                $dueTodayTasks,
                $dueThisWeekTasks,
                $dueNextWeekTasks
            ) {
                return $overdueTasks->contains($task)
                    || $dueTodayTasks->contains($task)
                    || $dueThisWeekTasks->contains($task)
                    || $dueNextWeekTasks->contains($task);
            });

        }



        $overdue = $this->sortOpenWork($overdueActivities->merge($overdueTasks)->sortBy('due_date'));
        $dueToday = $this->sortOpenWork($dueTodayActivities->merge($dueTodayTasks)->sortBy('due_date'));
        $dueThisWeek = $this->sortOpenWork($dueThisWeekActivities->merge($dueThisWeekTasks)->sortBy('due_date'));
        $dueNextWeek = $this->sortOpenWork($dueNextWeekActivities->merge($dueNextWeekTasks)->sortBy('due_date'));
        $dueLater = $this->sortOpenWork($dueLaterActivities->merge($dueLaterTasks)->sortBy('due_date'));

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



    public function getCompletedWorkForUser(User $user)//, $startDate, $endDate)
    {
        $activities = $this->activityProvider->getCompletedActivitiesForUser($user);

        $activities->load('tasks', 'owner', 'owner.headshots', 'formDocs', 'file', 'file.fileType', 'file.headshots');

        $documents = $this->documentProvider->getCompletedDocumentsForUser($user);

        $documents->load('file', 'file.fileType', 'file.headshots', 'activity', 'activity.file.headshots');

        $tasks = $this->taskProvider->getCompletedTasksForUser($user);

        $tasks->load('activity', 'activity.file', 'activity.file.fileType', 'activity.file.headshots');

        $today = $user->today();



        $completedTodayActivities = $activities->filter(function($activity) use ($today) {
            return $activity->completed_at->isSameDay($today);
        });

        $completedThisWeekActivities = $activities->filter(function($activity) use ($today) {
            return $activity->completed_at->isSameWeek($today);
        })->reject(function($activity) use ($completedTodayActivities) {
            return $completedTodayActivities->contains($activity);
        });

        $completedThisMonthActivities = $activities->filter(function($activity) use ($today) {
            return $activity->completed_at->isSameMonth($today);
        })->reject(function($activity) use ($completedTodayActivities, $completedThisWeekActivities) {
            return $completedTodayActivities->contains($activity) || $completedThisWeekActivities->contains($activity);
        });

        $completedEarlierActivities = $activities->reject(function($activity) use (
            $completedTodayActivities,
            $completedThisWeekActivities,
            $completedThisMonthActivities
        ) {
            return $completedTodayActivities->contains($activity)
                || $completedThisWeekActivities->contains($activity)
                || $completedThisMonthActivities->contains($activity);
        });



        $completedTodayDocuments = $documents->filter(function($doc) use ($today) {
            return $doc->submitted_at->isSameDay($today);
        });

        $completedThisWeekDocuments = $documents->filter(function($doc) use ($today) {
            return $doc->submitted_at->isSameWeek($today);
        })->reject(function($doc) use ($completedTodayDocuments) {
            return $completedTodayDocuments->contains($doc);
        });

        $completedThisMonthDocuments = $documents->filter(function($doc) use ($today) {
            return $doc->submitted_at->isSameMonth($today);
        })->reject(function($doc) use ($completedTodayDocuments, $completedThisWeekDocuments) {
            return $completedTodayDocuments->contains($doc) || $completedThisWeekDocuments->contains($doc);
        });

        $completedEarlierDocuments = $documents->reject(function($doc) use (
            $completedTodayDocuments,
            $completedThisWeekDocuments,
            $completedThisMonthDocuments
        ) {
            return $completedTodayDocuments->contains($doc)
                || $completedThisWeekDocuments->contains($doc)
                || $completedThisMonthDocuments->contains($doc);
        });



        $completedTodayTasks = $tasks->filter(function($task) use ($today) {
            return $task->completed_at->isSameDay($today);
        });

        $completedThisWeekTasks = $tasks->filter(function($task) use ($today) {
            return $task->completed_at->isSameWeek($today);
        })->reject(function($task) use ($completedTodayTasks) {
            return $completedTodayTasks->contains($task);
        });

        $completedThisMonthTasks = $tasks->filter(function($task) use ($today) {
            return $task->completed_at->isSameMonth($today);
        })->reject(function($task) use ($completedTodayTasks, $completedThisWeekTasks) {
            return $completedTodayTasks->contains($task) || $completedThisWeekTasks->contains($task);
        });

        $completedEarlierTasks = $tasks->reject(function($task) use (
            $completedTodayTasks,
            $completedThisWeekTasks,
            $completedThisMonthTasks
        ) {
            return $completedTodayTasks->contains($task)
                || $completedThisWeekTasks->contains($task)
                || $completedThisMonthTasks->contains($task);
        });


        $completedToday = $this->sortCompletedWork(
            $completedTodayDocuments->merge($completedTodayActivities)->merge($completedTodayTasks)
        );

        $completedThisWeek = $this->sortCompletedWork(
            $completedThisWeekDocuments->merge($completedThisWeekActivities)->merge($completedThisWeekTasks)
        );

        $completedThisMonth = $this->sortCompletedWork(
            $completedThisMonthDocuments->merge($completedThisMonthActivities)->merge($completedThisMonthTasks)
        );

        $completedEarlier = $this->sortCompletedWork(
            $completedEarlierDocuments->merge($completedEarlierActivities)->merge($completedEarlierTasks)
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
