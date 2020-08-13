<?php

namespace App\Policies;

use App\Authorization\Administrator;
use App\Authorization\SharedTeamMembership;
use App\FileType;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FileTypePolicy
{
    use HandlesAuthorization;

    private $sharedTeamMembership;
    private $administrator;

    public function __construct(SharedTeamMembership $sharedTeamMembership, Administrator $administrator)
    {
        $this->sharedTeamMembership = $sharedTeamMembership;
        $this->administrator = $administrator;
    }

    /**
     * Determine whether the user can view the file type.
     *
     * @param  \App\User  $user
     * @param  \App\FileType  $fileType
     * @return mixed
     */
    public function view(User $user, FileType $fileType)
    {
        return $this->administrator->authorize($user)
            || $this->sharedTeamMembership->authorize($user, $fileType);
    }
}
