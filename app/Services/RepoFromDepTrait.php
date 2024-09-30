<?php

namespace App\Services;

trait RepoFromDepTrait
{
    /**
     * Получить репозитории из зависимостей.
     *
     * @param array $dependencies
     *
     * @return object
     */
    public function getRepositoriesFromDependencies(array $dependencies): object
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
