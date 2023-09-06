<?php

namespace App\Traits\Contractors;

use App\Notifications\Contractors\Created;
use App\Notifications\Contractors\Updated;
use App\Repositories\Admin\UserRepository;
use Illuminate\Support\Facades\Notification;

/**
 * E-mail уведомления.
 */
trait Notifications
{
    /**
     * Отправка e-mail уведомления о заведении нового контрагента.
     *
     * @return void
     */
    public function sendEmailCreatedNotification(): void
    {
        $to = (new UserRepository())->getForEmailCreatedContractorNotification();

        Notification::route('mail', $to)
            ->notify(
                (new Created($this))
            );
    }

    /**
     * Отправка e-mail уведомления об изменении основной информации контрагента.
     *
     * @return void
     */
    public function sendEmailUpdatedNotification(): void
    {
        $to = (new UserRepository())->getForEmailCreatedContractorNotification();

        Notification::route('mail', $to)
            ->notify(
                (new Updated($this))
            );
    }
}
