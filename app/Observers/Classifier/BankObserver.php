<?php

namespace App\Observers\Classifier;

use App\Logging\Logger;
use App\Models\Classifier\Bank;

class BankObserver
{
    /**
     * Handle the Bank "created" event.
     *
     * @param Bank $bank
     *
     * @return void
     */
    public function created(Bank $bank)
    {
        Logger::userActionNotice('create', $bank);
    }

    /**
     * Handle the Bank "updated" event.
     *
     * @param Bank $bank
     *
     * @return void
     */
    public function updated(Bank $bank)
    {
        Logger::userActionNotice('update', $bank);
    }
}
