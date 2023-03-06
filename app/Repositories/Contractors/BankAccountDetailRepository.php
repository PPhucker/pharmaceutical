<?php

namespace App\Repositories\Contractors;

use App\Repositories\CoreRepository;
use App\Models\Contractors\BankAccountDetail as Model;
class BankAccountDetailRepository extends CoreRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }
}
