<?php

namespace App\Services;

/**
 * Сервис для контроллеров без методов create и edit.
 */
abstract class CrudService extends CoreService
{
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

    /**
     * Получить данные для метода index() контроллера.
     *
     * @return array
     */
    abstract public function getIndexData(): array;
}
