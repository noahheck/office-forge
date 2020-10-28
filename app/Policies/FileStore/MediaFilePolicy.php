<?php

namespace App\Policies\FileStore;

use App\Authorization\SharedTeamMembership;
use App\FileStore\MediaFile;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MediaFilePolicy
{
    use HandlesAuthorization;

    private $sharedTeamMembership;

    public function __construct(SharedTeamMembership $sharedTeamMembership)
    {
        $this->sharedTeamMembership = $sharedTeamMembership;
    }

    /**
     * Determine whether the user can view any media files.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the media file.
     *
     * @param  \App\User  $user
     * @param  \App\FileStore\MediaFile  $mediaFile
     * @return mixed
     */
    public function view(User $user, MediaFile $mediaFile)
    {
        return $user->can('view', $mediaFile->drive);
    }

    /**
     * Determine whether the user can create media files.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the media file.
     *
     * @param  \App\User  $user
     * @param  \App\FileStore\MediaFile  $mediaFile
     * @return mixed
     */
    public function update(User $user, MediaFile $mediaFile)
    {
        return $user->can('editContents', $mediaFile->drive);
    }

    /**
     * Determine whether the user can delete the media file.
     *
     * @param  \App\User  $user
     * @param  \App\FileStore\MediaFile  $mediaFile
     * @return mixed
     */
    public function delete(User $user, MediaFile $mediaFile)
    {
        return $user->can('editContents', $mediaFile->drive);
    }

    /**
     * Determine whether the user can restore the media file.
     *
     * @param  \App\User  $user
     * @param  \App\FileStore\MediaFile  $mediaFile
     * @return mixed
     */
    public function restore(User $user, MediaFile $mediaFile)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the media file.
     *
     * @param  \App\User  $user
     * @param  \App\FileStore\MediaFile  $mediaFile
     * @return mixed
     */
    public function forceDelete(User $user, MediaFile $mediaFile)
    {
        //
    }
}
