<?php

namespace App\Traits\Repository;

/**
 * Трейт для отношений "многие ко многим".
 */
trait BelongsToManyRepositoryTrait
{
    /**
     * @param object $target
     * @param array  $options
     *
     * @return void
     */
    public function attach(object $target, array $options): void
    {
        $target->attach($options);
    }

    /**
     * @param object     $target
     * @param array|null $options
     *
     * @return void
     */
    public function detach(object $target, array $options = null): void
    {
        $target->detach($options);
    }

    /**
     * @param object $target
     * @param        $key
     * @param array  $options
     *
     * @return void
     */
    public function updateExistingPivot(object $target, $key, array $options): void
    {
        $target->updateExistingPivot($key, $options);
    }
}
