<?php

namespace App\Traits\Policy;

use App\Models\Auth\User;

/**
 * Трейт политики для удаления/восстановления
 */
trait SoftDeletesPolicy
{
    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param      $model
     *
     * @return bool
     */
    public function delete(User $user, $model): bool
    {
        return $user->canDelete()
            && !$model->trashed();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param      $model
     *
     * @return bool
     */
    public function restore(User $user, $model): bool
    {
        return $user->canRestore()
            && $model->trashed();
    }
}
