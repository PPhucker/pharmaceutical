<?php

namespace App\Repositories\Admin\Organizations;

use App\Repositories\CoreRepository;
use App\Models\Admin\Organizations\Trailer as Model;

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
