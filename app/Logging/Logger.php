<?php

namespace App\Logging;

use App\Helpers\Model;
use Carbon\CarbonInterval;
use DatePeriod;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use JsonException;

class Logger
{
    public const ACTION_CREATE = 'create';
    public const ACTION_UPDATE = 'update';
    public const ACTION_DESTROY = 'destroy';
    public const ACTION_RESTORE = 'restore';

    private const USER_ACTION_NOTICE_MESSAGE = 'USER_ACTION';

    private const DISK_NAME = 'logs';
    private const COUNT_DAYS_FOR_DELETING = 95;

    /**
     * Parse logs.
     *
     * @param string $fromDate
     * @param string $toDate
     * @param array  $filters
     * @param array  $messages
     *
     * @return Collection|string
     */
    public static function parse(
        string $fromDate,
        string $toDate,
        array $filters = [],
        array $messages = [self::USER_ACTION_NOTICE_MESSAGE]
    ) {
        $interval = new DatePeriod(
            Carbon::create($fromDate),
            CarbonInterval::day(),
            Carbon::create($toDate)->addDay()
        );

        $logsStorage = Storage::disk(self::DISK_NAME);

        $parsed = collect();

        foreach ($interval as $day) {
            $logname = 'laravel-' . $day->format('Y-m-d') . '.log';

            if (!$logsStorage->exists($logname)) {
                continue;
            }

            try {
                $log = $logsStorage->get($logname);
            } catch (FileNotFoundException $exception) {
                return $exception->getMessage();
            }

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

                    if (!in_array($row->get('message'), $messages, true)) {
                        continue;
                    }

                    $context = $row->get('context');


                    if (
                        isset($filters['user'])
                        && (int)$filters['user'] !== $context->user->id
                    ) {
                        continue;
                    }

                    if (
                        isset($filters['action'])
                        && $filters['action'] !== $context->action
                    ) {
                        continue;
                    }

                    if (
                        isset($filters['model'])
                        && $filters['model'] !== $context->model
                    ) {
                        continue;
                    }

                    $parsed->push(
                        collect(
                            [
                                'context' => $context,
                                'datetime' => Carbon::create($row->get('datetime'))
                                    ->format('d.m.Y H:i:s')
                            ]
                        )
                    );
                } catch (JsonException $exception) {
                    return $exception->getMessage();
                }
            }
        }

        return collect(compact('parsed'));
    }

    /**
     * Create user action notice.
     *
     * @param string $action
     * @param            $model
     * @param array|null $relations
     *
     * @return void
     */
    public static function userActionNotice(string $action, $model, ?array $relations = [])
    {
        $info = collect(
            [
                'action' => $action,
                'user' => self::user(),
                'model' => get_class($model),
                'primary_key' => $model->getKey(),
                'table' => $model->getTable(),
            ]
        );

        switch ($action) {
            case 'create':
                $info->put(
                    'changes',
                    [
                        'attributes' => $model->getAttributes()
                    ]
                );
                break;
            case 'update':
                if (
                    $model->isDirty()
                    && !array_key_exists('deleted_at', $model->getChanges())
                ) {
                    $info->put(
                        'changes',
                        [
                            'attributes' => Model::getDirtyAttributes($model)
                        ]
                    );
                }
                break;
            case 'attach' || 'detach':
                $info->put(
                    'changes',
                    [
                        'attributes' => [
                            'table' => $relations ? $relations['table'] : null,
                            'id' => $relations ? $relations['id'] : null
                        ]
                    ]
                );
                break;
            case 'destroy' || 'restore':
                break;
        }

        logger()->notice(
            self::USER_ACTION_NOTICE_MESSAGE,
            $info->toArray()
        );
    }

    /**
     * Returns user information.
     *
     * @return Collection
     */
    protected static function user()
    {
        $user = Auth::user();

        $clientIp = Request::getClientIp();

        if (auth()->check()) {
            return collect(
                [
                    'ip' => $clientIp,
                    'id' => $user->id,
                    'name' => $user->name
                ]
            );
        }

        return collect(
            [
                'ip' => $clientIp,
                'id' => null,
                'name' => 'unauthorized user'
            ]
        );
    }

    /**
     * @return void
     */
    public static function delete()
    {
        collect(Storage::disk(self::DISK_NAME)->listContents())
            ->each(static function ($file) {
                if (
                    $file['type'] === 'file'
                    && $file['extension'] === 'log'
                    && $file['timestamp'] < now()->subDays(self::COUNT_DAYS_FOR_DELETING)->getTimestamp()
                ) {
                    Storage::disk(self::DISK_NAME)->delete($file['path']);
                }
            });
    }
}
