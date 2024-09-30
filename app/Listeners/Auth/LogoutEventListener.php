<?php

namespace App\Listeners\Auth;

use App\Logging\Logger;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Auth;

/**
 * Прослушиватель для выхода из системы.
 */
class LogoutEventListener
{
    /**
     * Handle the event.
     *
     * @param Logout $event
     *
     * @return void
     */
    public function handle(Logout $event): void
    {
        (new Logger())->userActionNotice(
            'logout',
            Auth::user()
        );
    }
}
