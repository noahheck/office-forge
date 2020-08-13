<?php

namespace App\Policies\FileType;

use App\Authorization\Administrator;
use App\Authorization\SharedTeamMembership;
use App\FileType\Panel;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PanelPolicy
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
     * Determine whether the user can view any panels.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the panel.
     *
     * @param  \App\User  $user
     * @param  \App\FileType\Panel  $panel
     * @return mixed
     */
    public function view(User $user, Panel $panel)
    {
        return $this->administrator->authorize($user)
            || $this->sharedTeamMembership->authorize($user, $panel);
    }

    /**
     * Determine whether the user can create panels.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the panel.
     *
     * @param  \App\User  $user
     * @param  \App\FileType\Panel  $panel
     * @return mixed
     */
    public function update(User $user, Panel $panel)
    {
        //
    }

    /**
     * Determine whether the user can delete the panel.
     *
     * @param  \App\User  $user
     * @param  \App\FileType\Panel  $panel
     * @return mixed
     */
    public function delete(User $user, Panel $panel)
    {
        //
    }

    /**
     * Determine whether the user can restore the panel.
     *
     * @param  \App\User  $user
     * @param  \App\FileType\Panel  $panel
     * @return mixed
     */
    public function restore(User $user, Panel $panel)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the panel.
     *
     * @param  \App\User  $user
     * @param  \App\FileType\Panel  $panel
     * @return mixed
     */
    public function forceDelete(User $user, Panel $panel)
    {
        //
    }
}
