<?php

namespace App\Observers\Contractors;

use App\Logging\Logger;
use App\Models\Contractors\ContactPerson;

class ContactPersonObserver
{
    /**
     * Handle the ContactPerson "created" event.
     *
     * @param ContactPerson $contactPerson
     *
     * @return void
     */
    public function created(ContactPerson $contactPerson)
    {
        Logger::userActionNotice('create', $contactPerson);
    }

    /**
     * Handle the ContactPerson "updated" event.
     *
     * @param ContactPerson $contactPerson
     *
     * @return void
     */
    public function updated(ContactPerson $contactPerson)
    {
        Logger::userActionNotice('update', $contactPerson);
    }

    /**
     * Handle the ContactPerson "deleted" event.
     *
     * @param ContactPerson $contactPerson
     *
     * @return void
     */
    public function deleted(ContactPerson $contactPerson)
    {
        Logger::userActionNotice('destroy', $contactPerson);
    }

    /**
     * Handle the ContactPerson "restored" event.
     *
     * @param ContactPerson $contactPerson
     *
     * @return void
     */
    public function restored(ContactPerson $contactPerson)
    {
        Logger::userActionNotice('restore', $contactPerson);
    }
}
