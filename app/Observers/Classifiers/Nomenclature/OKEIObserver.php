<?php

namespace App\Observers\Classifiers\Nomenclature;

use App\Logging\Logger;
use App\Models\Classifiers\Nomenclature\OKEI;

class OKEIObserver
{
    /**
     * Handle the OKEI "created" event.
     *
     * @param OKEI $okei
     *
     * @return void
     */
    public function created(OKEI $okei)
    {
        Logger::userActionNotice('create', $okei);
    }

    /**
     * Handle the OKEI "updated" event.
     *
     * @param OKEI $okei
     *
     * @return void
     */
    public function updated(OKEI $okei)
    {
        Logger::userActionNotice('update', $okei);
    }
}
