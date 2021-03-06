<?php

namespace App\Policies;

use App\Authorization\Administrator;
use App\Authorization\SharedTeamMembership;
use App\FormDoc;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FormDocPolicy
{
    use HandlesAuthorization;

    /**
     * @var SharedTeamMembership
     */
    private $sharedTeamMembership;

    /**
     * @var Administrator
     */
    private $administrator;

    public function __construct(SharedTeamMembership $sharedTeamMembership, Administrator $administrator)
    {
        $this->sharedTeamMembership = $sharedTeamMembership;
        $this->administrator = $administrator;
    }

    /**
     * Determine whether the user can view any form docs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the form doc.
     *
     * @param  \App\User  $user
     * @param  \App\FormDoc  $formDoc
     * @return mixed
     */
    public function view(User $user, FormDoc $formDoc)
    {
        if ($user->id == $formDoc->creator_id) {

            return true;
        }

        if (!$formDoc->isSubmitted()) {

            return $this->administrator->authorize($user);
        }

        return $this->administrator->authorize($user)
            || $this->sharedTeamMembership->authorize($user, $formDoc->template, 'reviewingTeams');
    }

    /**
     * Determine whether the user can create form docs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, $template)
    {
        return $this->sharedTeamMembership->authorize($user, $template, 'creatingTeams');
    }

    /**
     * Determine whether the user can review form docs created from the provided template
     * @param User $user
     * @param $template
     * @return mixed
     */
    public function review(User $user, $template)
    {
        return $this->sharedTeamMembership->authorize($user, $template, 'reviewingTeams');
    }

    /**
     * Determine whether the user can update the form doc.
     *
     * @param  \App\User  $user
     * @param  \App\FormDoc  $formDoc
     * @return mixed
     */
    public function update(User $user, FormDoc $formDoc)
    {
        return $user->id == $formDoc->creator_id;
    }

    /**
     * Determine whether the user can delete the form doc.
     *
     * @param  \App\User  $user
     * @param  \App\FormDoc  $formDoc
     * @return mixed
     */
    public function delete(User $user, FormDoc $formDoc)
    {
        return $formDoc->id // FormDoc has been saved already
            && !$formDoc->isSubmitted() // The FormDoc has not been submitted
            && (
                // The user is the author of the FormDoc or an Administrator
                $this->administrator->authorize($user)
                || $user->id == $formDoc->creator_id
            );
    }

    /**
     * Determine whether the user can restore the form doc.
     *
     * @param  \App\User  $user
     * @param  \App\FormDoc  $formDoc
     * @return mixed
     */
    public function restore(User $user, FormDoc $formDoc)
    {
        return $this->administrator->authorize($user);
    }

    /**
     * Determine whether the user can permanently delete the form doc.
     *
     * @param  \App\User  $user
     * @param  \App\FormDoc  $formDoc
     * @return mixed
     */
    public function forceDelete(User $user, FormDoc $formDoc)
    {
        //
    }
}
