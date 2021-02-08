<?php

namespace App\Policies;

use App\ResourceFile;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResourceFilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any resource files.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the resource file.
     *
     * @param  \App\User  $user
     * @param  \App\ResourceFile  $resourceFile
     * @return mixed
     */
    public function view(User $user, ResourceFile $resourceFile)
    {
        $resource = $resourceFile->resource;

        return $user->can('view', $resource);
    }

    /**
     * Determine whether the user can create resource files.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the resource file.
     *
     * @param  \App\User  $user
     * @param  \App\ResourceFile  $resourceFile
     * @return mixed
     */
    public function update(User $user, ResourceFile $resourceFile)
    {
        //
    }

    /**
     * Determine whether the user can delete the resource file.
     *
     * @param  \App\User  $user
     * @param  \App\ResourceFile  $resourceFile
     * @return mixed
     */
    public function delete(User $user, ResourceFile $resourceFile)
    {
        $resource = $resourceFile->resource;

        return $user->can('update', $resource);
    }

    /**
     * Determine whether the user can restore the resource file.
     *
     * @param  \App\User  $user
     * @param  \App\ResourceFile  $resourceFile
     * @return mixed
     */
    public function restore(User $user, ResourceFile $resourceFile)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the resource file.
     *
     * @param  \App\User  $user
     * @param  \App\ResourceFile  $resourceFile
     * @return mixed
     */
    public function forceDelete(User $user, ResourceFile $resourceFile)
    {
        //
    }
}
