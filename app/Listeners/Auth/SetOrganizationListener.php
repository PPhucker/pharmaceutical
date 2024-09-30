<?php

namespace App\Listeners\Auth;

use App\Events\Auth\UserLoggedIn;

/**
 * Слушатель для установки в сессию выбранной организации.
 */
class SetOrganizationListener
{
    /**
     * Handle the event.
     *
     * @param UserLoggedIn $event
     *
     * @return void
     */
    public function handle(UserLoggedIn $event): void
    {
        session([
            'organization_id' => $event->organization->id,
            'organization_name' => $event->organization->full_name,
        ]);
    }
}
