<?php

namespace App\Services;

use App\Interfaces\Service\ServiceDependenciesInterface;

/**
 * Базовый сервис зависимостей.
 */
class CoreDependencyService implements ServiceDependenciesInterface
{
    /**
     * @var array
     */
    protected $repositories;

    /**
     * @return array
     */
    public function getRepositories(): array
    {
        return $this->repositories;
    }
}
