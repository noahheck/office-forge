<?php

namespace App\Policies;

use App\FormDoc;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FormDocPolicy
{
    use HandlesAuthorization;

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
//        return false;

        if ($user->id == $formDoc->creator_id) {
            return true;
        }

        return $formDoc->isAccessibleBy($user);
    }

    /**
     * Determine whether the user can create form docs.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, $template)
    {
        return $template->isAccessibleBy($user);
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
            && ($user->isAdministrator() || $user->id == $formDoc->creator_id) // The user is the author of the FormDoc or an Administrator
            ;
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
        return $user->isAdministrator();
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
