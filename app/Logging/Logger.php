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
     * @return Collection|null
     */
    public function parse(string $startDate, string $endDate, array $filters = []): ?Collection
    {
        return $this->executeWithLogging(function () use ($startDate, $endDate, $filters) {
            $interval = $this->dateHelper->getDateInterval($startDate, $endDate);
            return $this->logManager->parseLogs($interval, $filters);
        }, 'Error parsing logs: ');
    }

    /**
     * Выполняет переданное замыкание с логированием ошибок.
     *
     * @param callable $callback
     * @param string   $errorMessage
     *
     * @return object
     */
    private function executeWithLogging(callable $callback, string $errorMessage): ?object
    {
        try {
            return $callback();
        } catch (Exception $exception) {
            Log::error($errorMessage . $exception->getMessage());
            return null;
        }
    }

    /**
     * @param string $action
     * @param Model  $model
     * @param array  $relations
     *
     * @return void
     */
    public function userActionNotice(string $action, $model, array $relations = []): void
    {
        $this->executeWithLogging(function () use ($action, $model, $relations) {
            $this->logManager->userActionNotice($action, $model, $relations);
        }, 'Error creating user action notice: ');
    }

    /**
     * @return void
     */
    public function delete(): void
    {
        $this->executeWithLogging(function () {
            $this->logManager->delete();
        }, 'Error deleting old logs: ');
    }
}
