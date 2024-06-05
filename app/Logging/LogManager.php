<?php

namespace App\Logging;

use App\Helpers\ModelHelper;
use DatePeriod;
use Exception;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use JsonException;

use function array_key_exists;
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
     * Парсинг логов за указанный инвервал времени.
     *
     * @param DatePeriod $interval
     * @param array      $filters
     * @param array      $messages
     *
     * @return Collection|string
     */
    public function parseLogs(
        DatePeriod $interval,
        array $filters = [],
        array $messages = [self::USER_ACTION_NOTICE_MESSAGE]
    ) {
        $parsedLogs = collect();

        foreach ($interval as $day) {
            $logName = 'laravel-' . $day->format('Y-m-d') . '.log';

            if (!Storage::disk(self::DISK_NAME)->exists($logName)) {
                continue;
            }

            try {
                $log = Storage::disk(self::DISK_NAME)
                    ->get($logName);
                $parsedLogs = $parsedLogs->merge(
                    $this->parseLogContent(
                        $log,
                        $filters,
                        $messages
                    )
                );
            } catch (FileNotFoundException $exception) {
                return $exception->getMessage();
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
            try {
                $row = collect(
                    json_decode(
                        $row,
                        false,
                        512,
                        JSON_THROW_ON_ERROR
                    )
                );

                if (
                    !in_array(
                        $row->get('message'),
                        $messages,
                        true
                    )
                ) {
                    continue;
                }

                if (!$this->checkFilters($row, $filters)) {
                    continue;
                }

                $parsedLogs->push(
                    collect(
                        [
                            'context' => $row->get('context'),
                            'datetime' => Carbon::create(
                                $row->get('datetime')
                            )
                                ->format('d.m.Y H:i:s')
                        ]
                    )
                );
            } catch (JsonException $exception) {
                Log::error('Error parsing JSON in log file: ' . $exception->getMessage());
            }
        }

        return $parsedLogs;
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
        foreach ($filters as $key => $value) {
            switch ($key) {
                case 'user':
                    if ((int)$log->get('context')->user->id !== (int)$value) {
                        return false;
                    }
                    break;
                case 'action':
                    if ($log->get('context')->action !== $value) {
                        return false;
                    }
                    break;
                case 'model':
                    if ($log->get('context')->model !== $value) {
                        return false;
                    }
                    break;
            }
        }

        return true;
    }

    /**
     * Создание сообщения о совершенном пользователем действии.
     *
     * @param string $action
     * @param        $model
     * @param array  $relations
     *
     * @return void
     */
    public function userActionNotice(
        string $action,
        $model,
        array $relations = []
    ): void {
        try {
            $info = collect([
                'action' => $action,
                'user' => $this->getUserInfo(),
                'model' => get_class($model),
                'primary_key' => $model->getKey(),
                'table' => $model->getTable(),
            ]);

            $changesKey = 'changes';
            $attributesKey = 'attributes';

            switch ($action) {
                case 'create':
                    $info->put(
                        $changesKey,
                        [$attributesKey => $model->getAttributes()]
                    );
                    break;
                case 'update':
                    if (
                        $model->isDirty()
                        && !array_key_exists('deleted_at', $model->getChanges())
                    ) {
                        $info->put(
                            $changesKey,
                            [$attributesKey => ModelHelper::getDirtyAttributes($model)]
                        );
                    }
                    break;
                case 'attach':
                case 'detach':
                    $changes = [];

                    foreach ($relations as $key => $relation) {
                        $changes[$attributesKey][$key] = $relation;
                    }

                    $info->put($changesKey, $changes);
                    break;
                case 'destroy':
                case 'restore':
                    break;
            }
            \Log::notice(self::USER_ACTION_NOTICE_MESSAGE, $info->toArray());
        } catch (Exception $exception) {
            \Log::error('Error creating user action notice: ' . $exception->getMessage());
        }
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
                'name' => $user->name
            ];
        }

        return [
            'ip' => $clientIp,
            'id' => null,
            'name' => 'unauthorized user'
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
            $logFiles = collect(Storage::disk(self::DISK_NAME)->listContents());

            $timestamp = now()
                ->subDays(self::COUNT_DAYS_FOR_DELETING)
                ->getTimestamp();

            $logFiles->each(function ($file) use ($timestamp) {
                if (
                    $file['type'] === 'file' &&
                    $file['extension'] === 'log' &&
                    $file['timestamp'] < $timestamp
                ) {
                    Storage::disk(self::DISK_NAME)->delete($file['path']);
                }
            });
        } catch (Exception $exception) {
            \Log::error('Error deleting old logs: ' . $exception->getMessage());
        }
    }
}
