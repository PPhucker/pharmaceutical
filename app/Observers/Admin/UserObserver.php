<?php

namespace App\Observers\Admin;

use App\Logging\Logger;
use App\Models\Auth\User;

class UserObserver
{
    /**
     * Handle the User "updated" event.
     *
     * @param User $user
     *
     * @return void
     */
    public function updated(User $user)
    {
        Logger::userActionNotice('update', $user);
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param User $user
     *
     * @return void
     */
    public function deleted(User $user)
    {
        Logger::userActionNotice('destroy', $user);
    }

    /**
     * Handle the User "restored" event.
     *
     * @param User $user
     *
     * @return void
     */
    public function restored(User $user)
    {
        Logger::userActionNotice('restore', $user);
    }
}
