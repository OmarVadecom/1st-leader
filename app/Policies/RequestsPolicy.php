<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RequestsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the contact.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        return check_permissions($user, 10);
    }

    /**
     * Determine whether the user can create contacts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return check_permissions($user, 10);
    }

    /**
     * Determine whether the user can update the contact.
     *
     * @param  \App\User  $user
     * @param  \App\Contact  $contact
     * @return mixed
     */
    public function update(User $user)
    {
        return check_permissions($user, 10);
    }

    /**
     * Determine whether the user can delete the contact.
     *
     * @param  \App\User  $user
     * @param  \App\Contact  $contact
     * @return mixed
     */
    public function delete(User $user)
    {
        return check_permissions($user, 10);
    }

    /**
     * Determine whether the user can restore the contact.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function restore(User $user)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the contact.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        //
    }
}
