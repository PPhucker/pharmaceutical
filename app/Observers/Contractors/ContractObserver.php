<?php

namespace App\Observers\Contractors;

use App\Logging\Logger;
use App\Models\Contractors\Contract;

/**
 * Наблюдатель за договором с контргентом.
 */
class ContractObserver
{
    /**
     * Handle the Contract "created" event.
     *
     * @param Contract $contract
     *
     * @return void
     */
    public function created(Contract $contract): void
    {
        Logger::userActionNotice('create', $contract);
    }

    /**
     * Handle the Contract "updated" event.
     *
     * @param Contract $contract
     *
     * @return void
     */
    public function updated(Contract $contract): void
    {
        Logger::userActionNotice('update', $contract);
    }

    /**
     * Handle the Contract "deleted" event.
     *
     * @param Contract $contract
     *
     * @return void
     */
    public function deleted(Contract $contract): void
    {
        Logger::userActionNotice('destroy', $contract);
    }

    /**
     * Handle the Contract "restored" event.
     *
     * @param Contract $contract
     *
     * @return void
     */
    public function restored(Contract $contract): void
    {
        Logger::userActionNotice('restore', $contract);
    }
}
