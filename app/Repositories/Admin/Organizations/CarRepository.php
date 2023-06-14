<?php

namespace App\Repositories\Admin\Organizations;

use App\Repositories\CoreRepository;
use App\Models\Admin\Organizations\Car as Model;

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
