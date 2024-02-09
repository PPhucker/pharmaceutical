<?php

namespace App\Observers\Classifier\Nomenclature\Product;

use App\Logging\Logger;
use App\Models\Classifier\Nomenclature\Products\OKPD2;

class OKPD2Observer
{
    /**
     * Handle the OKPD2 "created" event.
     *
     * @param OKPD2 $oKPD2
     *
     * @return void
     */
    public function created(OKPD2 $oKPD2)
    {
        Logger::userActionNotice('create', $oKPD2);
    }

    /**
     * Handle the OKPD2 "updated" event.
     *
     * @param OKPD2 $oKPD2
     *
     * @return void
     */
    public function updated(OKPD2 $oKPD2)
    {
        Logger::userActionNotice('update', $oKPD2);
    }
}
