<?php

namespace App\Policies\Documents\Shipment\PackingLists;

use App\Models\Auth\User;
use App\Models\Documents\Shipment\PackingLists\PackingList;
use Illuminate\Auth\Access\HandlesAuthorization;

class PackingListPolicy
{
    use HandlesAuthorization;

    private const ROLES = [
        'marketing',
        'bokkeeping',
        'digital_communication',
    ];

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     *
     * @return bool
     */
    public function viewAny(User $user)
    {
        return $user->hasRole(self::ROLES);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     *
     * @return bool
     */
    public function view(User $user)
    {
        return $user->hasRole(self::ROLES);
    }

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
     * @param User        $user
     * @param PackingList $packingList
     *
     * @return bool
     */
    public function update(User $user, PackingList $packingList)
    {
        return ($user->hasRole(['marketing', 'bookkeeping']) && !$packingList->approved)
            || ($user->hasPermission(['appove_shipment_documents']));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     *
     * @return bool
     */
    public function delete(User $user)
    {
        return $user->hasRole(['marketing', 'bookkeeping'])
            && $user->canDelete();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     *
     * @return bool
     */
    public function restore(User $user)
    {
        return $user->hasRole(['marketing', 'bookkeeping'])
            && $user->canRestore();
    }
}
