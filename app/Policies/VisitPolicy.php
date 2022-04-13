<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Visits;

class VisitPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     * @param  Visits $visit
     * @return mixed
     */
    public function view(Visits $visit)
    {
        return check_permissions($visit, 19);
    }

    /**
     * Determine whether the user can create models.
     * @param  Visits $visit
     * @return mixed
     */
    public function create(Visits $visit)
    {
        return check_permissions($visit, 16);
    }

    /**
     * Determine whether the user can edit the model.
     * @param  Visits $visit
     * @return mixed
     */
    public function edit(Visits $visit)
    {
        return check_permissions($visit, 17);
    }

    /**
     * Determine whether the user can Show the model.
     * @param  Visits $visit
     * @return mixed
     */
    public function show(Visits $visit)
    {
        return check_permissions($visit, 18);
    }

    /**
     * Determine whether the user can Show the model.
     * @param  Visits $visit
     * @return mixed
     */
    public function show_preparing_orders(Visits $visit)
    {
        return check_permissions($visit, 5);
    }

    /**
     * Determine whether the user can Show the model.
     * @param  Visits $visit
     * @return mixed
     */
    public function show_delivery_orders(Visits $visit)
    {
        return check_permissions($visit, 6);
    }

    /**
     * Determine whether the user can Show the model.
     * @param  Visits $visit
     * @return mixed
     */
    public function preparing_orders(Visits $visit)
    {
        return check_permissions($visit, 7);
    }

    /**
     * Determine whether the user can Show the model.
     * @param  Visits $visit
     * @return mixed
     */
    public function available_report(Visits $visit)
    {
        return check_permissions($visit, 8);
    }

    /**
     * Determine whether the user can Show the model.
     * @param  Visits $visit
     * @return mixed
     */
    public function delivery_orders(Visits $visit)
    {
        return check_permissions($visit, 9);
    }

    /**
     * Determine whether the user can Show the model.
     * @param  Visits $visit
     * @return mixed
     */
    public function booked_report(Visits $visit)
    {
        return check_permissions($visit, 10);
    }

    /**
     * Determine whether the user can Show the model.
     * @param  Visits $visit
     * @return mixed
     */
    public function reports_sells(Visits $visit)
    {
        return check_permissions($visit, 11);
    }

    /**
     * Determine whether the user can Show the model.
     * @param  Visits $visit
     * @return mixed
     */
    public function sells_of_day(Visits $visit)
    {
        return check_permissions($visit, 12);
    }

    /**
     * Determine whether the user can Show the model.
     * @param  Visits $visit
     * @return mixed
     */
    public function sold_report(Visits $visit)
    {
        return check_permissions($visit, 13);
    }

    /**
     * Determine whether the user can Show the model.
     * @param  Visits $visit
     * @return mixed
     */
    public function buy_report(Visits $visit)
    {
        return check_permissions($visit, 14);
    }

    /**
     * Determine whether the user can Show the model.
     * @param  Visits $visit
     * @return mixed
     */
    public function map_visits(Visits $visit)
    {
        return check_permissions($visit, 15);
    }
}
