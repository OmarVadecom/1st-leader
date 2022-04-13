<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Preparation;

class PreparationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     * @param  Preparation $preparation
     * @return mixed
     */
    public function view(Preparation $preparation)
    {
        return check_permissions($preparation, 28);
    }

    /**
     * Determine whether the user can create models.
     * @param  Preparation $preparation
     * @return mixed
     */
    public function create(Preparation $preparation)
    {
        return check_permissions($preparation, 25);
    }

    /**
     * Determine whether the user can edit the model.
     * @param  Preparation $preparation
     * @return mixed
     */
    public function edit(Preparation $preparation)
    {
        return check_permissions($preparation, 26);
    }

    /**
     * Determine whether the user can Show the model.
     * @param  Preparation $preparation
     * @return mixed
     */
    public function show(Preparation $preparation)
    {
        return check_permissions($preparation, 27);
    }
}
