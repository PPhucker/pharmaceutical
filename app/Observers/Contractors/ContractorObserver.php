<?php

namespace App\Observers\Contractors;

use App\Models\Contractors\Contractor;
use App\Notifications\Contractor\Created;
use App\Notifications\Contractor\Updated;
use App\Observers\CoreObserver;
use Auth;

/**
 * Наблюдатель контрагента.
 */
class ContractorObserver extends CoreObserver
{
    /**
     * Handle the Contractor "created" event.
     *
     * @param $model
     *
     * @return void
     */
    public function created($model): void
    {
        parent::created($model);

        $model->sendEmail((new Created($model)));
    }

    /**
     * Handle the Contractor "updating" event.
     *
     * @param Contractor $contractor
     *
     * @return void
     */
    public function updating(Contractor $contractor): void
    {
        if (Auth::user()->hasRole(['marketing', 'bookkeeping'])) {
            $contractor->sendEmail((new Updated($contractor)));
        }
    }
}
