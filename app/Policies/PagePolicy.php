<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
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
        return check_permissions($user, 13);
    }

    /**
     * Determine whether the user can create pages.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return check_permissions($user, 11);
    }

    /**
     * Determine whether the user can update the page.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        return check_permissions($user, 12);
    }

    /**
     * Determine whether the user can delete the page.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return check_permissions($user, 14);
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
