<?php


namespace App\Activity\Task;


use App\Activity\Task;
use App\User;

class TaskProvider
{
    /**
     * @var Task
     */
    private $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function getOpenTasksForUser(User $user)
    {
        $assignedTasks = $user->assignedTasks()->open()->get();

        return $assignedTasks->sortBy('due_date');
    }

    public function getCompletedTasksForUser(User $user)
    {
        $assignedTasks = $user->assignedTasks()->completed()->get();

        return $assignedTasks->sortBy('completed_at');
    }
}
