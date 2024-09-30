<?php

namespace App\Observers;

use App\Helpers\ModelHelper;
use App\Logging\Logger;

/**
 * Базовый наблюдатель.
 */
class CoreObserver
{
    /**
     * @var Logger
     */
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger();
    }

    /**
     * Handle the model "created" event.
     *
     * @param $model
     *
     * @return void
     */
    public function created($model): void
    {
        $this->logger->userActionNotice('create', $model);
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
        if (ModelHelper::modelIsDirty($model)) {
            $this->logger->userActionNotice('update', $model);
        }
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
        $this->logger->userActionNotice('destroy', $model);

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
        $this->logger->userActionNotice('restore', $model);

        foreach ($model->relationships(['HasMany']) as $relation) {
            foreach ($model->$relation()->get() as $item) {
                $item->restore();
            }
        }
    }
}
