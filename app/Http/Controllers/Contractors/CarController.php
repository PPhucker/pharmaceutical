<?php

namespace App\Http\Controllers\Contractors;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Contractors\Cars\StoreCarRequest;
use App\Http\Requests\Contractors\Cars\UpdateCarRequest;
use App\Models\Contractors\Car;
use App\Repositories\Contractors\CarRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CarController extends CoreController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCarRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreCarRequest $request)
    {
        $validated = $request->validated()['car'];

        $car = Car::create(
            [
                'user_id' => Auth::user()->id,
                'contractor_id' => (int)$validated['contractor_id'],
                'car_model' => $validated['car_model'],
                'state_number' => $validated['state_number'],
            ]
        );

        return back()
            ->with(
                'success',
                __(
                    'contractors.cars.actions.create.success',
                    ['number' => $car->state_number]
                )
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
    public function update(UpdateCarRequest $request, Car $car)
    {
        $validated = $request->validated();

        foreach ($validated['cars'] as $validatedCar) {
            Car::find((int)$validatedCar['id'])
                ->fill(
                    [
                        'user_id' => Auth::user()->id,
                        'car_model' => $validatedCar['car_model'],
                        'state_number' => $validatedCar['state_number'],
                    ]
                )
                ->save();
        }
        return back()
            ->with(
                'success',
                __('contractors.cars.actions.update.success')
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Car $car
     *
     * @return RedirectResponse
     */
    public function destroy(Car $car)
    {
        $car->delete();

        return back()
            ->with(
                'success',
                __(
                    'contractors.cars.actions.delete.success',
                    ['number' => $car->state_number]
                )
            );
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param Car $car
     *
     * @return RedirectResponse
     */
    public function restore(Car $car)
    {
        $car->restore();

        return back()
            ->with(
                'success',
                __(
                    'contractors.cars.actions.create.success',
                    ['number' => $car->state_number]
                )
            );
    }

    /**
     * @return void
     */
    protected function authorizeActions()
    {
        $this->authorizeResource(Car::class, 'car');
    }

    /**
     * @return string
     */
    protected function getRepository()
    {
        return CarRepository::class;
    }
}
