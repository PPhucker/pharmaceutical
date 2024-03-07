<?php

namespace App\Services;

use App\Interfaces\Service\ServiceDependenciesInterface;

/**
 * Базовый сервис зависимостей.
 */
abstract class CoreDependencyService implements ServiceDependenciesInterface
{
    /**
     * @var array
     */
    protected $repositories;

    /**
     * @var array
     */
    protected $relatedDependencies;

    /**
     * @return array
     */
    public function getRepositories(): array
    {
        return $this->repositories;
    }

    /**
     * @return void
     */
    public function registerRelatedDependencies(): void
    {
        $this->repositories = array_merge(
            $this->repositories,
            (array)$this->getRepositoriesFromDependencies(
                collect($this->relatedDependencies)
                    ->map(function ($d) {
                        return app($d);
                    })->toArray()
            )
        );
    }
}
