<?php

namespace App\Observers\Contractors;

use App\Logging\Logger;
use App\Models\Contractors\Contractor;
use Auth;

/**
 * Наблюдатель контрагента.
 */
class ContractorObserver
{
    /**
     * Таблицы с отношениями.
     */
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
    public function created(Contractor $contractor): void
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
    public function updated(Contractor $contractor): void
    {
        Logger::userActionNotice('update', $contractor);
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
            $contractor->sendEmailUpdatedNotification();
        }
    }

    /**
     * Handle the Contractor "deleted" event.
     *
     * @param Contractor $contractor
     *
     * @return void
     */
    public function deleted(Contractor $contractor): void
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
    public function restored(Contractor $contractor): void
    {
        Logger::userActionNotice('restore', $contractor);

        foreach (self::RELATIONS as $relation) {
            foreach ($contractor->$relation()->get() as $item) {
                $item->restore();
            }
        }
    }
}
