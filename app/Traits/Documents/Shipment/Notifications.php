<?php

namespace App\Traits\Documents\Shipment;

use App\Notifications\Shipment\Created;
use App\Repositories\Admin\UserRepository;
use Illuminate\Support\Facades\Notification;

trait Notifications
{
    /**
     * Отправка e-mail уведомления о создании комплекта документов на отгрузку.
     *
     * @return void
     */
    public function sendEmailCreatedShipment()
    {
        $to = (new UserRepository())->getForCreatedShipmentNotification();

        Notification::route('mail', $to)
            ->notify(
                (new Created($this))
            );
    }
}
