<?php

namespace App\Policies\Contractor\Transport;

use App\Models\Contractor\Transport\Car;
use App\Policies\CorePolicy;
use App\Traits\Policy\SoftDeletes;

/**
 * Политика автомобиля контрагента.
 */
class CarPolicy extends CorePolicy
{
    use SoftDeletes;

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Car::class;
    }

    protected function getRoles(): array
    {
        return config('roles.contractor', ['admin']);
    }
}
