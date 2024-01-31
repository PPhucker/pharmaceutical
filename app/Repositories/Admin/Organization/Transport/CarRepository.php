<?php

namespace App\Repositories\Admin\Organization\Transport;

use App\Models\Admin\Organization\Transport\Car as Model;
use App\Repositories\CoreRepository;

class CarRepository extends CoreRepository
{

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}
