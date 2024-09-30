<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

/**
 * Базовый класс репозитория.
 */
abstract class CoreRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    /**
     * @return string
     */
    abstract protected function getModelClass(): string;

    protected function clone()
    {
        return clone $this->model;
    }

    /**
     * @return Collection
     */
    abstract public function getAll(): Collection;
}
