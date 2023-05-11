<?php

namespace App\Observers\Contractors;

use App\Logging\Logger;
use App\Models\Contractors\Contractor;

class ContractorObserver
{
    private const RELATIONS = [
        'placesOfBusiness',
        'bankAccountDetails',
        'contactPersons',
        'drivers',
        'cars',
        'trailers',
    ];

    /**
     * Handle the Contractor "created" event.
     *
     * @param Contractor $contractor
     *
     * @return void
     */
    public function created(Contractor $contractor)
    {
        Logger::userActionNotice('create', $contractor);

        $contractor->sendEmailCreatedNotification();
    }

    /**
     * Handle the Contractor "updated" event.
     *
     * @param Contractor $contractor
     *
     * @return void
     */
    public function updated(Contractor $contractor)
    {
        Logger::userActionNotice('update', $contractor);
    }

    /**
     * Handle the Contractor "deleted" event.
     *
     * @param Contractor $contractor
     *
     * @return void
     */
    public function deleted(Contractor $contractor)
    {
        Logger::userActionNotice('destroy', $contractor);

        foreach (self::RELATIONS as $relation) {
            foreach ($contractor->$relation()->get() as $item) {
                $item->delete();
            }
        }
    }

    /**
     * Handle the Contractor "restored" event.
     *
     * @param Contractor $contractor
     *
     * @return void
     */
    public function restored(Contractor $contractor)
    {
        Logger::userActionNotice('restore', $contractor);

        foreach (self::RELATIONS as $relation) {
            foreach ($contractor->$relation()->get() as $item) {
                $item->restore();
            }
        }
    }
}
