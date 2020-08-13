<?php

namespace App\Policies\FileType;

use App\Authorization\Administrator;
use App\Authorization\SharedTeamMembership;
use App\FileType\Form;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FormPolicy
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
     * Determine whether the user can view the form.
     *
     * @param  \App\User  $user
     * @param  \App\FileType\Form  $form
     * @return mixed
     */
    public function view(User $user, Form $form)
    {
        return $this->administrator->authorize($user)
            || $this->sharedTeamMembership->authorize($user, $form);
    }

    /**
     * Determine whether the user can update the form.
     *
     * @param  \App\User  $user
     * @param  \App\FileType\Form  $form
     * @return mixed
     */
    public function update(User $user, Form $form)
    {
        return $this->administrator->authorize($user)
            || $this->sharedTeamMembership->authorize($user, $form);
    }
}
