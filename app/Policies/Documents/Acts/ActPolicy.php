<?php

namespace App\Policies\Documents\Acts;

use App\Models\Auth\User;
use App\Models\Documents\Acts\Act;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActPolicy
{
    use HandlesAuthorization;

    private const ROLES = [
        'marketing',
        'bookkeeping',
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
        return $user->hasRole(self::ROLES);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
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
     * @param User $user
     *
     * @return bool
     */
    public function delete(User $user)
    {
        return $user->hasRole(self::ROLES) && $user->canDelete();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Act  $act
     *
     * @return bool
     */
    public function restore(User $user, Act $act)
    {
        return $user->hasRole(self::ROLES) && $user->canRestore();
    }
}
