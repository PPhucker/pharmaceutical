<?php

namespace App\Repositories\Contractors;

use App\Repositories\CoreRepository;
use App\Models\Contractors\ContactPerson as Model;


class ContactPersonRepository extends CoreRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }
}
