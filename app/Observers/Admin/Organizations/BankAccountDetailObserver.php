<?php

namespace App\Observers\Admin\Organizations;

use App\Logging\Logger;
use App\Models\Admin\Organizations\BankAccountDetail;

class BankAccountDetailObserver
{
    /**
     * Handle the BankAccountDetail "created" event.
     *
     * @param BankAccountDetail $bankAccountDetail
     *
     * @return void
     */
    public function created(BankAccountDetail $bankAccountDetail)
    {
        Logger::userActionNotice('create', $bankAccountDetail);
    }

    /**
     * Handle the BankAccountDetail "updated" event.
     *
     * @param BankAccountDetail $bankAccountDetail
     *
     * @return void
     */
    public function updated(BankAccountDetail $bankAccountDetail)
    {
        Logger::userActionNotice('update', $bankAccountDetail);
    }

    /**
     * Handle the BankAccountDetail "deleted" event.
     *
     * @param BankAccountDetail $bankAccountDetail
     *
     * @return void
     */
    public function deleted(BankAccountDetail $bankAccountDetail)
    {
        Logger::userActionNotice('destroy', $bankAccountDetail);
    }

    /**
     * Handle the BankAccountDetail "restored" event.
     *
     * @param BankAccountDetail $bankAccountDetail
     *
     * @return void
     */
    public function restored(BankAccountDetail $bankAccountDetail)
    {
        Logger::userActionNotice('restore', $bankAccountDetail);
    }
}
