<?php

namespace App\Repositories\Contractors;

use App\Repositories\CoreRepository;
use App\Models\Contractors\Trailer as Model;

class TrailerRepository extends CoreRepository
{

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}
