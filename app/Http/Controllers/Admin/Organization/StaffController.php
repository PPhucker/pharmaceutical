<?php

namespace App\Http\Controllers\Admin\Organization;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Admin\Organization\Staff\StoreStaffRequest;
use App\Http\Requests\Admin\Organization\Staff\UpdateStaffRequest;
use App\Models\Admin\Organization\Staff;
use App\Services\Admin\Organization\StaffService;
use Illuminate\Http\RedirectResponse;

/**
 * Контроллер сотрудника организации.
 */
class StaffController extends CoreController
{
    /**
     * @var StaffService
     */
    private $service;

    /**
     * @param StaffService $service
     */
    public function __construct(StaffService $service)
    {
        $this->service = $service;
        $this->authorizeResource(Staff::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreStaffRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreStaffRequest $request): RedirectResponse
    {
        $this->service->create(
            $request->validated()['staff']
        );

        return $this->successRedirect();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateStaffRequest $request
     * @param Staff              $staff
     *
     * @return RedirectResponse
     */
    public function update(UpdateStaffRequest $request, Staff $staff): RedirectResponse
    {
        $this->service->update(
            $staff,
            $request->validated()['staff']
        );

        return $this->successRedirect();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Staff $staff
     *
     * @return RedirectResponse
     */
    public function destroy(Staff $staff): RedirectResponse
    {
        $this->service->delete($staff);

        return $this->successRedirect();
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param Staff $staff
     *
     * @return RedirectResponse
     */
    public function restore(Staff $staff): RedirectResponse
    {
        $this->service->restore($staff);

        return $this->successRedirect();
    }
}
