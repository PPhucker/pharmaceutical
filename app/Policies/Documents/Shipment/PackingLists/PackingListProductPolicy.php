<?php

namespace App\Policies\Documents\Shipment\PackingLists;

use App\Models\Auth\User;
use App\Models\Documents\Shipment\PackingLists\PackingListProduct;
use Illuminate\Auth\Access\HandlesAuthorization;

class PackingListProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     *
     * @return bool
     */
    public function create(User $user)
    {
        return $user->hasRole(['marketing', 'bookkeeping']);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User               $user
     * @param PackingListProduct $packingListProduct
     *
     * @return bool
     */
    public function update(User $user, PackingListProduct $packingListProduct)
    {
        return $user->hasRole(['marketing', 'bookkeeping'])
            && !$packingListProduct->packingList->approved;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User               $user
     * @param PackingListProduct $packingListProduct
     *
     * @return bool
     */
    public function delete(User $user, PackingListProduct $packingListProduct)
    {
        return $user->canDelete()
            && !$packingListProduct->packingList->approved;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User               $user
     * @param PackingListProduct $packingListProduct
     *
     * @return bool
     */
    public function restore(User $user, PackingListProduct $packingListProduct)
    {
        return $user->canRestore()
            && !$packingListProduct->packingList->approved;
    }
}
