<?php

namespace App\Observers\Admin\Organizations;

use App\Logging\Logger;
use App\Models\Admin\Organizations\Organization;

class OrganizationObserver
{
    private const RELATIONS = [
        'placesOfBusiness',
        'bankAccountDetails',
        'staff',
        'catalogProducts',
        'productPrices',
        'drivers',
    ];

    /**
     * Handle the Organization "created" event.
     *
     * @param Organization $organization
     *
     * @return void
     */
    public function created(Organization $organization)
    {
        Logger::userActionNotice('create', $organization);
    }

    /**
     * Handle the Organization "updated" event.
     *
     * @param Organization $organization
     *
     * @return void
     */
    public function updated(Organization $organization)
    {
        Logger::userActionNotice('update', $organization);
    }

    /**
     * Handle the Organization "deleted" event.
     *
     * @param Organization $organization
     *
     * @return void
     */
    public function deleted(Organization $organization)
    {
        Logger::userActionNotice('destroy', $organization);

        foreach (self::RELATIONS as $relation) {
            foreach ($organization->$relation()->get() as $item) {
                $item->delete();
            }
        }
    }

    /**
     * Handle the Organization "restored" event.
     *
     * @param Organization $organization
     *
     * @return void
     */
    public function restored(Organization $organization)
    {
        Logger::userActionNotice('restore', $organization);

        foreach (self::RELATIONS as $relation) {
            foreach ($organization->$relation()->get() as $item) {
                $item->restore();
            }
        }
    }
}
