<?php

namespace App\Interfaces\Service;

/**
 * Интерфейс зависимостей сервисов.
 */
interface ServiceDependenciesInterface
{
    /**
     * @return array
     */
    public function getRepositories(): array;

    /**
     * @return void
     */
    public function registerRelatedDependencies(): void;
}
