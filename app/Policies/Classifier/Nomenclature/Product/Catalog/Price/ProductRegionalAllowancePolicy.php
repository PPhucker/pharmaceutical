<?php

namespace App\Policies\Classifier\Nomenclature\Product\Catalog\Price;

use App\Models\Auth\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Политика региональных надбавок готовой продукции.
 */
class ProductRegionalAllowancePolicy
{
    use HandlesAuthorization;

    private const ROLES = [
        'bookkeeping',
        'marketing',
    ];

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     *
     * @return bool
     */
    public function create(User $user): bool
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
    public function update(User $user): bool
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
    public function delete(User $user): bool
    {
        return $user->canDelete();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     *
     * @return bool
     */
    public function restore(User $user): bool
    {
        return $user->canRestore();
    }
}
