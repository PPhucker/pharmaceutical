<?php

namespace App\Services;

/**
 * Ресурсный сервис
 */
abstract class ResourceService extends CrudService
{
    /**
     * Получить данные для метода index() контроллера.
     *
     * @return array
     */
    abstract public function getIndexData(): array;

    /**
     * Получить данные для метода edit() контроллера.
     *
     * @param $model
     *
     * @return array
     */
    abstract public function getEditData($model): array;

    /**
     * Получить данные для метода create() контроллера.
     *
     * @return array
     */
    abstract public function getCreateData(): array;
}
