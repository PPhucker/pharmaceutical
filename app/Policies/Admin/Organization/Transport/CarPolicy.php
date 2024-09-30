<?php

namespace App\Policies\Admin\Organization\Transport;

use App\Models\Admin\Organization\Transport\Car;
use App\Policies\CorePolicy;
use App\Traits\Policy\SoftDeletesPolicy;

/**
 * Политика для автомобиля контрагента.
 */
class CarPolicy extends CorePolicy
{
    use SoftDeletesPolicy;

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Car::class;
    }

    /**
     * @return array
     */
    protected function getRoles(): array
    {
        return ['admin'];
    }
}
