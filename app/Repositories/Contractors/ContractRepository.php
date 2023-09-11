<?php

namespace App\Repositories\Contractors;

use App\Repositories\CoreRepository;
use App\Models\Contractors\Contract as Model;

/**
 * Репозиторий договора с контрагентом.
 */
class ContractRepository extends CoreRepository
{
    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }
}
