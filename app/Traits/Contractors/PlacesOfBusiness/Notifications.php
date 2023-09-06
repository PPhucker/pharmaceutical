<?php

namespace App\Traits\Contractors\PlacesOfBusiness;

use App\Notifications\Contractors\PlacesOfBusiness\Created;
use App\Notifications\Contractors\PlacesOfBusiness\Updated;
use App\Repositories\Admin\UserRepository;
use Illuminate\Support\Facades\Notification;

/**
 * Уведомления о действиях с местами осуществления деятельности контрагента.
 */
trait Notifications
{
    /**
     * Отправка e-mail уведомления о добавлении нового места осуществления деятельности.
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
     * Отправка e-mail уведомления об изменении места осуществления деятельности.
     *
     * @return void
     */
    public function sendEmailUpdatedNotification(array $changes): void
    {
        $to = (new UserRepository())->getForEmailCreatedContractorNotification();

        Notification::route('mail', $to)
            ->notify(
                (new Updated($this, $changes))
            );
    }
}
