<?php

namespace App\Observers\Admin\Organizations;

use App\Logging\Logger;
use App\Models\Admin\Organizations\Staff;

class StaffObserver
{
    /**
     * Handle the Staff "created" event.
     *
     * @param Staff $staff
     *
     * @return void
     */
    public function created(Staff $staff)
    {
        Logger::userActionNotice('create', $staff);
    }

    /**
     * Handle the Staff "updated" event.
     *
     * @param Staff $staff
     *
     * @return void
     */
    public function updated(Staff $staff)
    {
        Logger::userActionNotice('update', $staff);
    }

    /**
     * Handle the Staff "deleted" event.
     *
     * @param Staff $staff
     *
     * @return void
     */
    public function deleted(Staff $staff)
    {
        Logger::userActionNotice('destroy', $staff);
    }

    /**
     * Handle the Staff "restored" event.
     *
     * @param Staff $staff
     *
     * @return void
     */
    public function restored(Staff $staff)
    {
        Logger::userActionNotice('restore', $staff);
    }
}
