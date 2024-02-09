<?php

namespace App\Observers\Classifier;

use App\Logging\Logger;
use App\Models\Classifier\LegalForm;

class LegalFormObserver
{
    /**
     * Handle the LegalForm "created" event.
     *
     * @param LegalForm $legalForm
     *
     * @return void
     */
    public function created(LegalForm $legalForm)
    {
        Logger::userActionNotice('create', $legalForm);
    }

    /**
     * Handle the LegalForm "updated" event.
     *
     * @param LegalForm $legalForm
     *
     * @return void
     */
    public function updated(LegalForm $legalForm)
    {
        Logger::userActionNotice('update', $legalForm);
    }
}
