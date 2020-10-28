<?php

namespace App\Policies\FileStore;

use App\Authorization\SharedTeamMembership;
use App\FileStore\Drive;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DrivePolicy
{
    use HandlesAuthorization;

    private $sharedTeamMembership;

    public function __construct(SharedTeamMembership $sharedTeamMembership)
    {
        $this->sharedTeamMembership = $sharedTeamMembership;
    }

    /**
     * Determine whether the user can view any drives.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the drive.
     *
     * @param  \App\User  $user
     * @param  \App\FileStore\Drive  $drive
     * @return mixed
     */
    public function view(User $user, Drive $drive)
    {
        return $this->sharedTeamMembership->authorize($user, $drive);
    }

    /**
     * Determine whether the user can make modifications to the content of the drive (add/change/remove files/folders)
     * @param User $user
     * @param Drive $drive
     * @return mixed
     */
    public function editContents(User $user, Drive $drive)
    {
        return $this->sharedTeamMembership->authorize($user, $drive, 'editingTeams');
    }

    /**
     * Determine whether the user can create drives.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the drive.
     *
     * @param  \App\User  $user
     * @param  \App\FileStore\Drive  $drive
     * @return mixed
     */
    public function update(User $user, Drive $drive)
    {
        //
    }

    /**
     * Determine whether the user can delete the drive.
     *
     * @param  \App\User  $user
     * @param  \App\FileStore\Drive  $drive
     * @return mixed
     */
    public function delete(User $user, Drive $drive)
    {
        //
    }

    /**
     * Determine whether the user can restore the drive.
     *
     * @param  \App\User  $user
     * @param  \App\FileStore\Drive  $drive
     * @return mixed
     */
    public function restore(User $user, Drive $drive)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the drive.
     *
     * @param  \App\User  $user
     * @param  \App\FileStore\Drive  $drive
     * @return mixed
     */
    public function forceDelete(User $user, Drive $drive)
    {
        //
    }
}
