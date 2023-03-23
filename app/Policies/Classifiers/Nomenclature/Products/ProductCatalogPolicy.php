<?php

namespace App\Policies\Classifiers\Nomenclature\Products;

use App\Models\Auth\User;
use App\Models\Classifiers\Nomenclature\Products\ProductCatalog;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductCatalogPolicy
{
    use HandlesAuthorization;

    private const ROLES = [
        'marketing',
        'planning',
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
     * @param User           $user
     * @param ProductCatalog $productCatalog
     *
     * @return bool
     */
    public function delete(User $user, ProductCatalog $productCatalog)
    {
        return $user->isAdmin();
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
        return $user->isAdmin();
    }
}