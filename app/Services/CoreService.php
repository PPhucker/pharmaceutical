<?php

namespace App\Services;

/**
 * Базовый сервис.
 */
abstract class CoreService
{
    /**
     * @var object
     */
    protected $repositories;

    /**
     * Получить репозитории из зависимостей.
     *
     * @param array $dependencies
     *
     * @return object
     */
    protected function getRepositoriesFromDependencies(array $dependencies): object
    {
        $repositories = array_map(
            static function ($dep) {
                return $dep->getRepositories();
            },
            $dependencies
        );

        return (object)array_merge(...$repositories);
    }
}
