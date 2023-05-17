<?php

namespace App\Http\Controllers\Contractors;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Contractors\Drivers\StoreDriverRequest;
use App\Http\Requests\Contractors\Drivers\UpdateDriverRequest;
use App\Models\Contractors\Driver;
use App\Repositories\Contractors\DriverRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class DriverController extends CoreController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDriverRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreDriverRequest $request)
    {
        $validated = $request->validated()['driver'];

        $driver = Driver::create(
            [
                'user_id' => Auth::user()->id,
                'contractor_id' => (int)$validated['contractor_id'],
                'name' => $validated['name'],
            ]
        );

        return back()
            ->with(
                'success',
                __(
                    'contractors.drivers.actions.create.success',
                    ['name' => $driver->name]
                )
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateDriverRequest $request
     * @param Driver              $driver
     *
     * @return RedirectResponse
     */
    public function update(UpdateDriverRequest $request, Driver $driver)
    {
        $validated = $request->validated();

        foreach ($validated['drivers'] as $validatedDriver) {
            Driver::find((int)$validatedDriver['id'])
                ->fill(
                    [
                        'user_id' => Auth::user()->id,
                        'name' => $validatedDriver['name'],
                    ]
                )
                ->save();
        }

        return back()
            ->with(
                'success',
                __('contractors.drivers.actions.update.success')
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Driver $driver
     *
     * @return RedirectResponse
     */
    public function destroy(Driver $driver)
    {
        $driver->delete();

        return back()
            ->with(
                'success',
                __(
                    'contractors.drivers.actions.delete.success',
                    ['name' => $driver->name]
                )
            );
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param Driver $driver
     *
     * @return RedirectResponse
     */
    public function restore(Driver $driver)
    {
        $driver->restore();

        return back()
            ->with(
                'success',
                __(
                    'contractors.drivers.actions.restore.success',
                    ['name' => $driver->name]
                )
            );
    }

    /**
     * @return void
     */
    protected function authorizeActions()
    {
        $this->authorizeResource(Driver::class, 'driver');
    }

    /**
     * @return string
     */
    protected function getRepository()
    {
        return DriverRepository::class;
    }
}
