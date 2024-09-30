<?php

namespace App\Http\Controllers\Contractor\Transport;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Contractor\Transport\Car\StoreCarRequest;
use App\Http\Requests\Contractor\Transport\Car\UpdateCarRequest;
use App\Models\Contractor\Transport\Car;
use App\Services\Contractor\Transport\CarService;
use App\Traits\Contractor\Controller\Transport\CarControllerTrait;
use Illuminate\Http\RedirectResponse;

/**
 * Контроллер автомобиля контрагента.
 */
class CarController extends CoreController
{
    use CarControllerTrait;

    /**
     * @var CarService
     */
    private $service;

    /**
     * @param CarService $service
     */
    public function __construct(CarService $service)
    {
        $this->service = $service;
        $this->authorizeResource(Car::class);
    }

    /**
     * @param StoreCarRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreCarRequest $request): RedirectResponse
    {
        return $this->traitStore($request);
    }

    /**
     * @param UpdateCarRequest $request
     * @param Car              $car
     *
     * @return RedirectResponse
     */
    public function update(UpdateCarRequest $request, Car $car): RedirectResponse
    {
        return $this->traitUpdate($request, $car);
    }

    /**
     * @param Car $car
     *
     * @return RedirectResponse
     */
    public function destroy(Car $car): RedirectResponse
    {
        return $this->traitDestroy($car);
    }

    /**
     * @param Car $car
     *
     * @return RedirectResponse
     */
    public function restore(Car $car): RedirectResponse
    {
        return $this->traitRestore($car);
    }
}
