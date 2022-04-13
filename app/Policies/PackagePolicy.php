<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PackagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the setting.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        return check_permissions($user, 9);
    }

    /**
     * Determine whether the user can create settings.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return check_permissions($user, 9);
    }

    /**
     * Determine whether the user can update the setting.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        return check_permissions($user, 9);
    }

    /**
     * Determine whether the user can delete the setting.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return check_permissions($user, 9);
    }

    /**
     * Determine whether the user can restore the setting.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function restore(User $user)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the setting.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        //
    }
}
