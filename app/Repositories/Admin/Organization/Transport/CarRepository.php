<?php

namespace App\Repositories\Admin\Organization\Transport;

use App\Repositories\Contractor\Transport\CarRepository as ContractorCarRepository;
use App\Models\Admin\Organization\Transport\Car;
use Auth;

/**
 * Репозиторий автомобиля организации
 */
class CarRepository extends ContractorCarRepository
{
    /**
     * @param array $validated
     *
     * @return Car
     */
    public function create(array $validated)
    {
        return $this->model->create(
            [
                'user_id' => Auth::user()->id,
                'organization_id' => (int)$validated['organization_id'],
                'car_model' => $validated['car_model'],
                'state_number' => $validated['state_number'],
            ]
        );
    }

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Car::class;
    }
}
