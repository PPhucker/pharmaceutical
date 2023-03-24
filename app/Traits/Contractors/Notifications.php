<?php

namespace App\Traits\Contractors;

use App\Notifications\Contractors\Created;
use App\Repositories\Admin\UserRepository;
use Illuminate\Support\Facades\Notification;

trait Notifications
{
    /**
     * Отправка e-mail уведомления о заведении нового контрагента.
     *
     * @return void
     */
    public function sendEmailCreatedNotification()
    {
        $to = (new UserRepository())->getForEmailCreatedContractorNotification();

        Notification::route('mail', $to)
            ->notify(
                (new Created($this))
            );
    }

}
