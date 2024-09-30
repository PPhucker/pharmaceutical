<?php

namespace App\Traits\Notification\Email;

use App\Repositories\Auth\PermissionRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Notification;

/**
 * Email пользователям с ролью согласования контрагентов.
 */
trait EmailToVerificationContractorsUsers
{
    /**
     * @param $notification
     *
     * @return void
     */
    public function sendEmail($notification): void
    {
        Notification::route('mail', $this->to())
            ->notify(
                $notification
            );
    }

    /**
     * @return Collection
     */
    private function to(): Collection
    {
        return (new PermissionRepository())
            ->getUsersByPermissions(['verification_contractors']);
    }
}
