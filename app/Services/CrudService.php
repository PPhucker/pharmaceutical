<?php

namespace App\Services;

/**
 *
 */
abstract class CrudService extends CoreService
{
    protected $selectedRepo;

    /**
     * Создать модель.
     *
     * @param array $validated
     *
     * @return mixed
     */
    public function create(array $validated)
    {
        return $this->selectedRepo->create($validated);
    }

    /**
     * Обновить модель.
     *
     * @param       $model
     * @param array $validated
     *
     * @return mixed
     */
    public function update($model, array $validated)
    {
        return $this->selectedRepo->update($model, $validated);
    }
}
