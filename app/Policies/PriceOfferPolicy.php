<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\PriceOffer;

class PriceOfferPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     * @param  PriceOffer $priceOffer
     * @return mixed
     */
    public function view(PriceOffer $priceOffer)
    {
        return check_permissions($priceOffer, 24);
    }

    /**
     * Determine whether the user can create models.
     * @param  PriceOffer $priceOffer
     * @return mixed
     */
    public function create(PriceOffer $priceOffer)
    {
        return check_permissions($priceOffer, 21);
    }

    /**
     * Determine whether the user can edit the model.
     * @param  PriceOffer $priceOffer
     * @return mixed
     */
    public function edit(PriceOffer $priceOffer)
    {
        return check_permissions($priceOffer, 22);
    }

    /**
     * Determine whether the user can Show the model.
     * @param  PriceOffer $priceOffer
     * @return mixed
     */
    public function show(PriceOffer $priceOffer)
    {
        return check_permissions($priceOffer, 23);
    }

    /**
     * Determine whether the user can Verify In Index Page.
     * @param  PriceOffer $priceOffer
     * @return mixed
     */
    public function index_verify(PriceOffer $priceOffer)
    {
        return check_permissions($priceOffer, 20);
    }
}
