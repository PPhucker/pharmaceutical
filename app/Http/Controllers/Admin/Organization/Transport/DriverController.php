<?php

namespace App\Http\Controllers\Admin\Organization\Transport;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Admin\Organization\Transport\Drivers\StoreDriverRequest;
use App\Http\Requests\Admin\Organization\Transport\Drivers\UpdateDriverRequest;
use App\Models\Admin\Organization\Transport\Driver;
use App\Services\Admin\Organization\Trasport\DriverService;
use App\Traits\Contractor\Controller\Transport\DriverControllerTrait;
use Illuminate\Http\RedirectResponse;

/**
 * Контроллер водителя организации.
 */
class DriverController extends CoreController
{
    use DriverControllerTrait;

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
        $this->authorizeResource(Driver::class, 'driver');
    }

    /**
     * @param StoreDriverRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreDriverRequest $request): RedirectResponse
    {
        return $this->traitStore($request);
    }

    /**
     * @param UpdateDriverRequest $request
     * @param Driver              $driver
     *
     * @return RedirectResponse
     */
    public function update(UpdateDriverRequest $request, Driver $driver): RedirectResponse
    {
        return $this->traitUpdate($request, $driver);
    }

    /**
     * @param Driver $driver
     *
     * @return RedirectResponse
     */
    public function destroy(Driver $driver): RedirectResponse
    {
        return $this->traitDestroy($driver);
    }

    /**
     * @param Driver $driver
     *
     * @return RedirectResponse
     */
    public function restore(Driver $driver): RedirectResponse
    {
        return $this->traitRestore($driver);
    }
}
