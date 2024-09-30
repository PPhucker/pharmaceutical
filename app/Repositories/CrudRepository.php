<?php

namespace App\Repositories;

/**
 *
 */
abstract class CrudRepository extends CoreRepository
{
    /**
     * @param array $validated
     *
     * @return mixed
     */
    abstract public function create(array $validated);

    /**
     * @param       $model
     * @param array $validated
     *
     * @return mixed
     */
    abstract public function update($model, array $validated);
}
