<?php

namespace App\Repositories\Contractor\Transport;

use App\Models\Contractor\Transport\Car;
use App\Repositories\CrudRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

/**
 * Репозиторий автомобиля контрагента.
 */
class CarRepository extends CrudRepository
{

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->clone()->all();
    }

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
                'contractor_id' => (int)$validated['contractor_id'],
                'car_model' => $validated['car_model'],
                'state_number' => $validated['state_number'],
            ]
        );
    }

    /**
     * @param       $model
     * @param array $validated
     *
     * @return void
     */
    public function update($model, array $validated): void
    {
        foreach ($validated as $validatedCar) {
            $this->model->findOrFail((int)$validatedCar['id'])
                ->fill(
                    [
                        'user_id' => Auth::user()->id,
                        'car_model' => $validatedCar['car_model'],
                        'state_number' => $validatedCar['state_number'],
                    ]
                )
                ->save();
        }
    }

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Car::class;
    }
}
