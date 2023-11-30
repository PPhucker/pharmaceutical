<?php

namespace App\Policies;

use App\Models\Auth\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Базовый класс политик.
 */
abstract class CorePolicy
{
    use HandlesAuthorization;

    /**
     * @var array
     */
    protected $roles;

    protected $model;

    /**
     * @param $model
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     *
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole($this->roles);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     *
     * @return bool
     */
    public function view(User $user): bool
    {
        return $user->hasRole($this->roles);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     *
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->hasRole($this->roles);
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
        return $user->hasRole($this->roles);
    }
}
