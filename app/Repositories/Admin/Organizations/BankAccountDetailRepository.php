<?php

namespace App\Repositories\Admin\Organizations;

use App\Repositories\CoreRepository;
use App\Models\Admin\Organizations\BankAccountDetail as Model;

class BankAccountDetailRepository extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function getAll()
    {
        return $this->clone()
            ->all();
    }
}
