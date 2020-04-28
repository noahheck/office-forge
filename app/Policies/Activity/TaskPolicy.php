<?php

namespace App\Policies\Activity;

use App\Activity;
use App\Activity\Task;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any tasks.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the task.
     *
     * @param  \App\User  $user
     * @param  \App\Activity\Task  $task
     * @return mixed
     */
    public function view(User $user, Task $task)
    {
        //
    }

    /**
     * Determine whether the user can create tasks.
     *
     * @param  \App\User  $user
     * @param Activity $activity
     * @return mixed
     */
    public function create(User $user, $activity)
    {
        return $activity->canHaveTasksEditedBy($user);
    }

    /**
     * Determine whether the user can update the task.
     *
     * @param  \App\User  $user
     * @param  \App\Activity\Task  $task
     * @param  \App\Activity $activity
     * @return mixed
     */
    public function update(User $user, Task $task)
    {
        if ($user->isAdministrator()) {

            return true;
        }

        if ($task->assigned_to == $user->id) {

            return true;
        }

        if ($task->activity->owner_id == $user->id) {

            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the task.
     *
     * @param  \App\User  $user
     * @param  \App\Activity\Task  $task
     * @return mixed
     */
    public function delete(User $user, Task $task)
    {
        if (!$task->id) {

            return false;
        }

        if ($task->process_task_id) {

            return false;
        }

        if ($user->isAdministrator()) {

            return true;
        }

        if ($task->activity->owner_id == $user->id) {

            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the task.
     *
     * @param  \App\User  $user
     * @param  \App\Activity\Task  $task
     * @return mixed
     */
    public function restore(User $user, Task $task)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the task.
     *
     * @param  \App\User  $user
     * @param  \App\Activity\Task  $task
     * @return mixed
     */
    public function forceDelete(User $user, Task $task)
    {
        //
    }
}
