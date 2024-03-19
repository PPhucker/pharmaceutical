<?php

namespace App\Services;

/**
 * Базовый сервис.
 */
abstract class CoreService
{
    use RepoFromDepTrait;

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
}
