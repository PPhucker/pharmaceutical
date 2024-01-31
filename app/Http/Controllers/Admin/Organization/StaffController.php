<?php

namespace App\Http\Controllers\Admin\Organization;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Admin\Organization\Staff\StoreStaffRequest;
use App\Http\Requests\Admin\Organization\Staff\UpdateStaffRequest;
use App\Models\Admin\Organization\Staff;
use App\Repositories\Admin\Organization\StaffRepozitory;
use Illuminate\Http\RedirectResponse;

class StaffController extends CoreController
{
    /**
     * @return void
     */
    protected function authorizeActions()
    {
        $this->authorizeResource(Staff::class, 'staff');
    }

    /**
     * @return string
     */
    protected function getRepository()
    {
        return StaffRepozitory::class;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreStaffRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreStaffRequest $request)
    {
        $validated = $request->validated()['staff'];

        $staff = Staff::create(
            [
                'organization_id' => $validated['organization_id'],
                'organization_place_of_business_id' => $validated['organization_place_of_business_id'],
                'name' => $validated['name'],
                'post' => $validated['post'],
            ]
        );

        return back()
            ->with(
                'success',
                __(
                    'contractors.staff.actions.create.success',
                    ['name' => $staff->name]
                )
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateStaffRequest $request
     *
     * @return RedirectResponse
     */
    public function update(UpdateStaffRequest $request)
    {
        $validated = $request->validated();

        foreach ($validated['staff'] as $staff) {
            Staff::find((int)$staff['id'])
                ->fill(
                    [
                        'organization_place_of_business_id' => $staff['organization_place_of_business_id'],
                        'name' => $staff['name'],
                        'post' => $staff['post'],
                    ]
                )
                ->save();
        }

        return back()
            ->with(
                'success',
                __('contractors.staff.actions.update.success')
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Staff $staff
     *
     * @return RedirectResponse
     */
    public function destroy(Staff $staff)
    {
        $staff->delete();

        return back()
            ->with(
                'success',
                __(
                    'contractors.staff.actions.destroy.success',
                    ['name' => $staff->name]
                )
            );
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param Staff $staff
     *
     * @return RedirectResponse
     */
    public function restore(Staff $staff)
    {
        $staff->restore();

        return back()
            ->with(
                'success',
                __(
                    'contractors.staff.actions.restore.success',
                    ['name' => $staff->name]
                )
            );
    }
}
