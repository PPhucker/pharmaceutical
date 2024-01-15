<?php

namespace App\Http\Controllers\Contractors\Transport;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Contractors\Transport\Drivers\StoreDriverRequest;
use App\Http\Requests\Contractors\Transport\Drivers\UpdateDriverRequest;
use App\Models\Contractors\Transport\Driver;
use App\Services\Contractor\Transport\DriverService;
use Illuminate\Http\RedirectResponse;

/**
 * Контроллер водителя контрагента.
 */
class DriverController extends CoreController
{
    protected $prefixLocalKey = 'contractors.drivers';
    /**
     * @var DriverService
     */
    private $service;

    /**
     * @param DriverService $service
     */
    public function __construct(DriverService $service)
    {
        $this->service = $service;
        $this->authorizeResource(Driver::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDriverRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreDriverRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $driver = $this->service->create($validated['driver']);

        return $this->successRedirect(
            'create',
            ['name' => $driver->name]
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
    public function update(UpdateDriverRequest $request, Driver $driver): RedirectResponse
    {
        $validated = $request->validated();

        $this->service->update($driver, $validated['drivers']);

        return $this->successRedirect('update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Driver $driver
     *
     * @return RedirectResponse
     */
    public function destroy(Driver $driver): RedirectResponse
    {
        $this->service->delete($driver);

        return $this->successRedirect(
            'delete',
            ['name' => $driver->name]
        );
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param Driver $driver
     *
     * @return RedirectResponse
     */
    public function restore(Driver $driver): RedirectResponse
    {
        $this->service->restore($driver);

        return $this->successRedirect(
            'restore',
            ['name' => $driver->name]
        );
    }
}
