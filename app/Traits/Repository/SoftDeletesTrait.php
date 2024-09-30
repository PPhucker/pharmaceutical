<?php

namespace App\Traits\Repository;

/**
 * Трейт мягкого удаления записей.
 */
trait SoftDeletesTrait
{
    /**
     * Удаление
     *
     * @param $model
     *
     * @return mixed
     */
    public function delete($model)
    {
        $model->delete();

        return $model;
    }

    /**
     * Восстановление.
     *
     * @param $model
     *
     * @return mixed
     */
    public function restore($model)
    {
        $model->restore();

        return $model;
    }
}
