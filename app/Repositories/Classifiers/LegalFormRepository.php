<?php

namespace App\Repositories\Classifiers;

use App\Models\Classifiers\LegalForm as Model;
use App\Repositories\CoreRepository;
use Illuminate\Database\Eloquent\Collection;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class LegalFormRepository extends CoreRepository
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
            ->orderBy('classifier_legal_forms.abbreviation')
            ->get();
    }
}
