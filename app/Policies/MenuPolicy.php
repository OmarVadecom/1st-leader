<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the page.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        return check_permissions($user, 26);
    }

    /**
     * Determine whether the user can create pages.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return check_permissions($user, 24);
    }

    /**
     * Determine whether the user can update the page.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        return check_permissions($user, 25);
    }

    /**
     * Determine whether the user can delete the page.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return check_permissions($user, 27);
    }

    /**
     * Determine whether the user can restore the page.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function restore(User $user)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the page.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        //
    }
}
