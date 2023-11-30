<?php

namespace App\Observers;

use App\Logging\Logger;

/**
 * Базовый наблюдатель.
 */
class CoreObserver
{
    /**
     * Handle the model "created" event.
     *
     * @param $model
     *
     * @return void
     */
    public function created($model): void
    {
        Logger::userActionNotice('create', $model);
    }

    /**
     * Handle the model "updated" event.
     *
     * @param $model
     *
     * @return void
     */
    public function updated($model): void
    {
        Logger::userActionNotice('update', $model);
    }

    /**
     * Handle the model "deleted" event.
     *
     * @param $model
     *
     * @return void
     */
    public function deleted($model): void
    {
        Logger::userActionNotice('destroy', $model);

        foreach ($model->relationships(['HasMany']) as $relation) {
            foreach ($model->$relation()->get() as $item) {
                $item->delete();
            }
        }
    }

    /**
     * Handle the Contractor "restored" event.
     *
     * @param $model
     *
     * @return void
     */
    public function restored($model): void
    {
        Logger::userActionNotice('restore', $model);

        foreach ($model->relationships(['HasMany']) as $relation) {
            foreach ($model->$relation()->get() as $item) {
                $item->restore();
            }
        }
    }
}
