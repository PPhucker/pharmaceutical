<?php

namespace App\Repositories;


/**
 * Репозиторий содержит все методы, аналогичные методам ресурсного контроллера.
 */
abstract class ResourceRepository extends CrudRepository
{
    /**
     * @param int $id
     *
     * @return mixed
     */
    abstract public function getForEdit(int $id);

    /**
     * @param array $validated
     *
     * @return array
     */
    abstract protected function getFilled(array $validated): array;
}
