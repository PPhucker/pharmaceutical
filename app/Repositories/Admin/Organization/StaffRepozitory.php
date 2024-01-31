<?php

namespace App\Repositories\Admin\Organization;

use App\Repositories\CoreRepository;
use App\Models\Admin\Organization\Staff as Model;

class StaffRepozitory extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }
}
