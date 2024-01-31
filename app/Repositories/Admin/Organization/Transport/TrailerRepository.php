<?php

namespace App\Repositories\Admin\Organization\Transport;

use App\Models\Admin\Organization\Transport\Trailer as Model;
use App\Repositories\CoreRepository;

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
