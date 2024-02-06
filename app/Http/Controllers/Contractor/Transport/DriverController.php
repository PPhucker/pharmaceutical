<?php

namespace App\Http\Controllers\Contractor\Transport;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Contractor\Transport\Driver\StoreDriverRequest;
use App\Http\Requests\Contractor\Transport\Driver\UpdateDriverRequest;
use App\Models\Contractor\Transport\Driver;
use App\Services\Contractor\Transport\DriverService;
use App\Traits\Contractor\Controller\Transport\DriverControllerTrait;
use Illuminate\Http\RedirectResponse;

/**
 * Контроллер водителя контрагента.
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
        $this->authorizeResource(Driver::class);
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
