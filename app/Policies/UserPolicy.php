<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     * @param  User $user
     * @return mixed
     */
    public function view(User $user)
    {
        return check_permissions($user, 5);
    }

    /**
     * Determine whether the user can create models.
     * @param  User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return check_permissions($user, 1);
    }

    /**
     * Determine whether the user can edit the model.
     * @param  User $user
     * @return mixed
     */
    public function edit(User $user)
    {
        return check_permissions($user, 3);
    }

    /**
     * Determine whether the user can Show the model.
     * @param  User $user
     * @return mixed
     */
    public function show(User $user)
    {
        return check_permissions($user, 4);
    }
}
