<?php

namespace App\Policies\FileStore;

use App\Authorization\SharedTeamMembership;
use App\FileStore\Folder;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FolderPolicy
{
    use HandlesAuthorization;

    private $sharedTeamMembership;

    public function __construct(SharedTeamMembership $sharedTeamMembership)
    {
        $this->sharedTeamMembership = $sharedTeamMembership;
    }

    /**
     * Determine whether the user can view any folders.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the folder.
     *
     * @param  \App\User  $user
     * @param  \App\FileStore\Folder  $folder
     * @return mixed
     */
    public function view(User $user, Folder $folder)
    {
        //
    }

    /**
     * Determine whether the user can create folders.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the folder.
     *
     * @param  \App\User  $user
     * @param  \App\FileStore\Folder  $folder
     * @return mixed
     */
    public function update(User $user, Folder $folder)
    {
        //
    }

    /**
     * Determine whether the user can delete the folder.
     *
     * @param  \App\User  $user
     * @param  \App\FileStore\Folder  $folder
     * @return mixed
     */
    public function delete(User $user, Folder $folder)
    {
        if ($folder->folders->count() > 0 || $folder->mediaFiles->count() > 0) {

            return false;
        }

        return $this->sharedTeamMembership->authorize($user, $folder->drive);
    }

    /**
     * Determine whether the user can restore the folder.
     *
     * @param  \App\User  $user
     * @param  \App\FileStore\Folder  $folder
     * @return mixed
     */
    public function restore(User $user, Folder $folder)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the folder.
     *
     * @param  \App\User  $user
     * @param  \App\FileStore\Folder  $folder
     * @return mixed
     */
    public function forceDelete(User $user, Folder $folder)
    {
        //
    }
}
