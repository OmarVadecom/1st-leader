<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SliderPolicy
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
        return check_permissions($user, 21);
    }

    /**
     * Determine whether the user can create pages.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return check_permissions($user, 19);
    }

    /**
     * Determine whether the user can update the page.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        return check_permissions($user, 21);
    }

    /**
     * Determine whether the user can delete the page.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return check_permissions($user, 22);
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
