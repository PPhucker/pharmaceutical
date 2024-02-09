<?php

namespace App\Policies\Classifier\Nomenclature\Product;

use App\Models\Auth\User;
use App\Models\Classifier\Nomenclature\Products\InternationalNameOfEndProduct;
use Illuminate\Auth\Access\HandlesAuthorization;

class InternationalNameOfEndProductPolicy
{
    use HandlesAuthorization;

    private const ROLES = [
        'marketing',
        'planning',
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
     * @param User                          $user
     * @param InternationalNameOfEndProduct $internationalNameOfEndProduct
     *
     * @return bool
     */
    public function view(User $user, InternationalNameOfEndProduct $internationalNameOfEndProduct)
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
}
