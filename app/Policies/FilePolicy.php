<?php

namespace App\Policies;

use App\Authorization\AccessLockAndKey;
use App\Authorization\Administrator;
use App\Authorization\SharedTeamMembership;
use App\File;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilePolicy
{
    use HandlesAuthorization;

    private $sharedTeamMembership;
    private $accessLockAndKey;
    private $administrator;

    public function __construct(
        SharedTeamMembership $sharedTeamMembership,
        AccessLockAndKey $accessLockAndKey,
        Administrator $administrator
    ) {
        $this->sharedTeamMembership = $sharedTeamMembership;
        $this->accessLockAndKey = $accessLockAndKey;
        $this->administrator = $administrator;
    }

    /**
     * Determine whether the user can view any files.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user, $fileType)
    {
        return $this->administrator->authorize($user)
            || $this->sharedTeamMembership->authorize($user, $fileType);
    }

    /**
     * Determine whether the user can view the file.
     *
     * @param  \App\User  $user
     * @param  \App\File  $file
     * @return mixed
     */
    public function view(User $user, File $file)
    {
        return $this->administrator->authorize($user)
            || (
                   $this->sharedTeamMembership->authorize($user, $file->fileType)
                && $this->accessLockAndKey->authorize($user, $file)
            );
    }

    /**
     * Determine whether the user can create files.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, $fileType)
    {
        return $this->administrator->authorize($user)
            || $this->sharedTeamMembership->authorize($user, $fileType);
    }

    /**
     * Determine whether the user can update the file.
     *
     * @param  \App\User  $user
     * @param  \App\File  $file
     * @return mixed
     */
    public function update(User $user, File $file)
    {
        return $this->administrator->authorize($user)
            || (
                   $this->sharedTeamMembership->authorize($user, $file->fileType)
                && $this->accessLockAndKey->authorize($user, $file)
            );
    }

    /**
     * Determine whether the user can delete the file.
     *
     * @param  \App\User  $user
     * @param  \App\File  $file
     * @return mixed
     */
    public function delete(User $user, File $file)
    {
        //
    }

    /**
     * Determine whether the user can restore the file.
     *
     * @param  \App\User  $user
     * @param  \App\File  $file
     * @return mixed
     */
    public function restore(User $user, File $file)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the file.
     *
     * @param  \App\User  $user
     * @param  \App\File  $file
     * @return mixed
     */
    public function forceDelete(User $user, File $file)
    {
        //
    }
}
