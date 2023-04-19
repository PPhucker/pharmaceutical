<?php

namespace App\Policies\Documents\InvoicesForPayment;

use App\Models\Auth\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvoiceForPaymentProductPolicy
{
    use HandlesAuthorization;

    private const ROLES = [
        'marketing',
        'bookkeeping',
    ];

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     *
     * @return bool
     */
    public function create(User $user)
    {
        return $user->hasRole(self::ROLES);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  User   $user
     *
     * @return bool
     */
    public function update(User $user)
    {
        return $user->hasRole(self::ROLES);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     *
     * @return bool
     */
    public function delete(User $user)
    {
        return $user->hasRole(self::ROLES);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  User   $user
     *
     * @return bool
     */
    public function restore(User $user)
    {
        return $user->hasRole(self::ROLES);
    }
}
