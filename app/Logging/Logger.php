<?php

namespace App\Logging;

use App\Helpers\DateHelper;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Log;

/**
 * Класс для работы с логами.
 */
class Logger
{
    /**
     * @var DateHelper
     */
    private $dateHelper;
    /**
     * @var LogManager
     */
    private $logManager;

    public function __construct()
    {
        $this->dateHelper = new DateHelper();
        $this->logManager = new LogManager();
    }

    /**
     * @param string $startDate
     * @param string $endDate
     * @param array  $filters
     *
     * @return Collection|string
     */
    public function parse(
        string $startDate,
        string $endDate,
        array $filters = []
    ) {
        try {
            $interval = $this->dateHelper
                ->getDateInterval($startDate, $endDate);

            return $this->logManager
                ->parseLogs($interval, $filters);
        } catch (Exception $exception) {
            Log::error('Error parsing logs: ' . $exception->getMessage());
            return 'Error parsing logs.';
        }
    }


    /**
     * @param string     $action
     * @param Model      $model
     * @param array|null $relations
     *
     * @return void
     */
    public function userActionNotice(
        string $action,
        $model,
        array $relations = []
    ): void {
        try {
            $this->logManager->userActionNotice($action, $model, $relations);
        } catch (Exception $exception) {
            Log::error('Error creating user action notice: ' . $exception->getMessage());
        }
    }

    /**
     * @return void
     */
    public function delete(): void
    {
        try {
            $this->logManager->delete();
        } catch (Exception $exception) {
            Log::error('Error deleting old logs: ' . $exception->getMessage());
        }
    }

}
