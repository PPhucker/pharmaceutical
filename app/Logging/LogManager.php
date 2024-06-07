<?php

namespace App\Logging;

use App\Models\Auth\User;
use DatePeriod;
use Exception;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use JsonException;

use function get_class;
use function in_array;

/**
 * Предоставляет методы для работы с логами.
 */
class LogManager
{
    private const USER_ACTION_NOTICE_MESSAGE = 'USER_ACTION';

    private const DISK_NAME = 'logs';

    private const COUNT_DAYS_FOR_DELETING = 95;
    /**
     * @var Filesystem|FilesystemAdapter
     */
    private $disk;
    /**
     * @var ActionHandler
     */
    private $actionHandler;

    /**
     * @param string $diskName
     */
    public function __construct(string $diskName = self::DISK_NAME)
    {
        $this->disk = Storage::disk($diskName);
        $this->actionHandler = new ActionHandler();
    }

    /**
     * Парсинг логов за указанный инвервал времени.
     *
     * @param DatePeriod $interval
     * @param array      $filters
     * @param array      $messages
     *
     * @return Collection
     */
    public function parseLogs(
        DatePeriod $interval,
        array $filters = [],
        array $messages = [self::USER_ACTION_NOTICE_MESSAGE]
    ): Collection {
        $parsedLogs = collect();

        foreach ($interval as $day) {
            $logName = 'laravel-' . $day->format('Y-m-d') . '.log';

            if (!$this->disk->exists($logName)) {
                continue;
            }

            try {
                $log = $this->disk->get($logName);
                $parsedLogs = $parsedLogs->merge(
                    $this->parseLogContent(
                        $log,
                        $filters,
                        $messages
                    )
                );
            } catch (FileNotFoundException $exception) {
                Log::error($exception->getMessage());
            }
        }

        return $parsedLogs;
    }

    /**
     * Парсинг содержимого лога, применяя указанные типы сообщений и фильтры.
     *
     * @param string $log
     * @param array  $filters
     * @param array  $messages
     *
     * @return Collection
     */
    protected function parseLogContent(
        string $log,
        array $filters,
        array $messages
    ): Collection {
        $parsedLogs = collect();
        foreach (explode("\n", trim($log)) as $row) {
            $parsedRow = $this->parseLogRow($row);
            if (!$parsedRow) {
                continue;
            }

            if (!in_array($parsedRow->get('message'), $messages, true)) {
                continue;
            }

            if (!$this->checkFilters($parsedRow, $filters)) {
                continue;
            }

            $parsedLogs->push(
                collect([
                    'context' => $parsedRow->get('context'),
                    'datetime' => Carbon::create($parsedRow->get('datetime'))
                        ->format('d.m.Y H:i:s')
                ])
            );
        }

        return $parsedLogs;
    }

    /**
     * Парсинг строки лога.
     *
     * @param string $row
     *
     * @return Collection|null
     */
    private function parseLogRow(string $row): ?Collection
    {
        try {
            return collect(json_decode($row, false, 512, JSON_THROW_ON_ERROR));
        } catch (JsonException $exception) {
            Log::error('Error parsing JSON in log file: ' . $exception->getMessage());
            return null;
        }
    }

    /**
     * Проверить, соответствует ли лог заданным фильтрам.
     *
     * @param Collection $log
     * @param array      $filters
     *
     * @return bool
     */
    protected function checkFilters(Collection $log, array $filters): bool
    {
        $context = $log->get('context');

        return collect($filters)
            ->every(function ($value, $key) use ($context) {
                switch ($key) {
                    case 'user':
                        return (int)($context->user->id) === (int)$value;
                    case 'action':
                        return $context->action === $value;
                    case 'model':
                        return $context->model === $value;
                    case 'start_date':
                    case 'to_date':
                        return true;
                    default:
                        return false;
                }
            });
    }


    /**
     * Создание сообщения о совершенном пользователем действии.
     *
     * @param string $action
     * @param Model  $model
     * @param array  $relations
     *
     * @return void
     */
    public function userActionNotice(string $action, $model, array $relations = []): void
    {
        try {
            $info = $this->prepareBaseInfo($action, $model);

            $this->actionHandler->handleAction($action, $info, $model, $relations);

            Log::notice(self::USER_ACTION_NOTICE_MESSAGE, $info->toArray());
        } catch (Exception $exception) {
            Log::error('Error creating user action notice: ' . $exception->getMessage());
        }
    }

    /**
     * Подготовка базовой информации для логирования.
     *
     * @param string $action
     * @param Model  $model
     *
     * @return Collection
     */
    private function prepareBaseInfo(string $action, $model): Collection
    {
        return collect([
            'action' => $action,
            'user' => $this->getUserInfo(),
            'model' => $model ? get_class($model) : User::class,
            'primary_key' => $model ? $model->getKey() : 0,
            'table' => $model ? $model->getTable() : 'users',
        ]);
    }

    /**
     * Возвращает информацию о пользователе.
     *
     * @return array
     */
    protected function getUserInfo(): array
    {
        $user = Auth::user();
        $clientIp = Request::getClientIp();

        if (auth()->check()) {
            return [
                'ip' => $clientIp,
                'id' => $user->id,
                'name' => $user->name,
            ];
        }

        return [
            'ip' => $clientIp,
            'id' => 0,
            'name' => 'Неавторизованный пользователь',
        ];
    }

    /**
     * Удаление старых логов.
     *
     * @return void
     */
    public function delete(): void
    {
        try {
            $logFiles = collect($this->disk->listContents());

            $timestamp = now()
                ->subDays(self::COUNT_DAYS_FOR_DELETING)
                ->getTimestamp();

            $logFiles->each(function ($file) use ($timestamp) {
                if (
                    $file['type'] === 'file' &&
                    $file['extension'] === 'log' &&
                    $file['timestamp'] < $timestamp
                ) {
                    $this->disk->delete($file['path']);
                }
            });
        } catch (Exception $exception) {
            Log::error('Error deleting old logs: ' . $exception->getMessage());
        }
    }
}
