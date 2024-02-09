<?php

namespace App\Repositories\Classifiers;

use App\Repositories\CoreRepository;
use App\Models\Classifier\Bank as Model;
use Illuminate\Support\Collection;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class BankRepository extends CoreRepository
{
    /**
     * @inheritDoc
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @return Collection
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getAll()
    {
        return $this->clone()
            ->orderBy('classifier_banks.name')
            ->get();
    }
}
