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
     * @var object
     */
    protected $selectedRepo;

    /**
     * Выбрать репозиторий.
     *
     * @return object
     */
    abstract protected function selectRepository(): object;

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
