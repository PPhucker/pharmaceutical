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
    private const USER_ACTION_NOTICE_MESSAGE = 'USER_ACTION';

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
                    'user_id' => $user->id,
                    'user_name' => $user->name
                ]
            );
        }

        return collect(
            [
                'ip' => $clientIp,
                'user_id' => null,
                'user_name' => 'unauthorized user'
            ]
        );
    }

    /**
     * Parse logs.
     *
     * @param string $fromDate
     * @param string $toDate
     * @param array  $messages
     *
     * @return Collection|string
     */
    public static function parse(
        string $fromDate,
        string $toDate,
        array $messages = [self::USER_ACTION_NOTICE_MESSAGE]
    ) {
        $interval = new DatePeriod(
            Carbon::create($fromDate),
            CarbonInterval::day(),
            Carbon::create($toDate)->addDay()
        );

        $logsStorage = Storage::disk('logs');

        $parsed = collect();

        foreach ($interval as $day) {
            $logname = 'laravel-' . $day->format('Y-m-d') . '.log';

            if (!$logsStorage->exists($logname)) {
                continue;
            }

            $parsed->put($day->format('d.m.Y'), collect());

            try {
                $log = $logsStorage->get($logname);
            } catch (FileNotFoundException $exception) {
                return $exception->getMessage();
            }

            foreach (explode("\n", trim($log)) as $row) {
                try {
                    $row = collect(json_decode($row, false, 512, JSON_THROW_ON_ERROR));

                    if (!in_array($row->get('message'), $messages, true)) {
                        continue;
                    }

                    $parsed->get($day->format('d.m.Y'))
                        ->push(
                            collect(
                                [
                                    'context' => $row->get('context'),
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

        return $parsed;
    }

    /**
     * Create user action notice.
     *
     * @param string $action
     * @param        $model
     *
     * @return void
     */
    public static function userActionNotice(string $action, $model)
    {
        $info = collect(
            [
                'action' => $action,
                'user' => self::user(),
                'model' => get_class($model),
            ]
        );

        switch ($action) {
            case 'create':
                $info->put('attributes', $model->getAttributes());
                break;
            case 'update':
                if ($model->isDirty() && $model->isClean('deleted_at')) {
                    $info->put('changes', Model::getDirtyAttributes($model));
                }
                break;
            case 'destroy' || 'restore':
                $info->put('item_id', $model->id);
                break;
        }

        logger()->notice(
            self::USER_ACTION_NOTICE_MESSAGE,
            $info->toArray()
        );
    }
}
