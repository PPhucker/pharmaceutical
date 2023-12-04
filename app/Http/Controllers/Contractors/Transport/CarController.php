<?php

namespace App\Http\Controllers\Contractors\Transport;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Contractors\Transport\Cars\StoreCarRequest;
use App\Http\Requests\Contractors\Transport\Cars\UpdateCarRequest;
use App\Models\Contractors\Transport\Car;
use App\Services\Contractor\Transport\CarService;
use Illuminate\Http\RedirectResponse;

/**
 * Контроллер автомобиля контрагента.
 */
class CarController extends CoreController
{
    protected $prefixLocalKey = 'contractors.cars';

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
     * Store a newly created resource in storage.
     *
     * @param StoreCarRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreCarRequest $request): RedirectResponse
    {
        $car = $this->service->create(
            $request->validated()['car']
        );

        return $this->successRedirect(
            'create',
            ['number' => $car->state_number]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCarRequest $request
     * @param Car              $car
     *
     * @return RedirectResponse
     */
    public function update(UpdateCarRequest $request, Car $car): RedirectResponse
    {
        $this->service->update(
            $car,
            $request->validated()['cars']
        );

        return $this->successRedirect('update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Car $car
     *
     * @return RedirectResponse
     */
    public function destroy(Car $car): RedirectResponse
    {
        $this->service->delete($car);

        return $this->successRedirect(
            'delete',
            ['number' => $car->state_number]
        );
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param Car $car
     *
     * @return RedirectResponse
     */
    public function restore(Car $car): RedirectResponse
    {
        $this->service->restore($car);

        return $this->successRedirect(
            'restore',
            ['number' => $car->state_number]
        );
    }
}
