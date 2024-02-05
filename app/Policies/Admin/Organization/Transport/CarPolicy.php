<?php

namespace App\Policies\Admin\Organization\Transport;

use App\Models\Admin\Organization\Transport\Car;
use App\Policies\Contractor\Transport\CarPolicy as ContractorCarPolicy;

/**
 * Политика для автомобиля контрагента.
 */
class CarPolicy extends ContractorCarPolicy
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Car::class;
    }
}
