<?php

namespace App\Repositories\Admin\Organizations;

use App\Repositories\CoreRepository;
use App\Models\Admin\Organizations\Staff as Model;

class StaffRepozitory extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }
}
