<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Delivery;

class DeliveryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     * @param  Delivery $delivery
     * @return mixed
     */
    public function view(Delivery $delivery)
    {
        return check_permissions($delivery, 32);
    }

    /**
     * Determine whether the user can create models.
     * @param  Delivery $delivery
     * @return mixed
     */
    public function create(Delivery $delivery)
    {
        return check_permissions($delivery, 29);
    }

    /**
     * Determine whether the user can edit the model.
     * @param  Delivery $delivery
     * @return mixed
     */
    public function edit(Delivery $delivery)
    {
        return check_permissions($delivery, 30);
    }

    /**
     * Determine whether the user can Show the model.
     * @param  Delivery $delivery
     * @return mixed
     */
    public function show(Delivery $delivery)
    {
        return check_permissions($delivery, 31);
    }
}
