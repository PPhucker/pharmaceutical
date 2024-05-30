<?php

namespace App\Helpers;

use DateInterval;
use DatePeriod;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * Класс для работы с датами и интервалами дат.
 */
class DateHelper
{
    /**
     * Получить начальную и конечную дату интервала.
     *
     * @param array  $validated
     * @param string $defaultInterval Интервал по умолчанию (по умолчанию 1 день).
     *
     * @return Collection
     */
    public static function getDateRange(
        array $validated,
        string $defaultInterval = '1 day'
    ): Collection {
        $startDate = $validated['start_date']
            ?? Carbon::now()->sub($defaultInterval)->format('Y-m-d');
        $endDate = $validated['end_date']
            ?? Carbon::now()->format('Y-m-d');

        return collect([
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);
    }

    /**
     * Получить даты интервала.
     *
     * @param string            $startDate
     * @param string            $endDate
     * @param DateInterval|null $interval
     * @param string            $format
     *
     * @return DatePeriod
     */
    public static function getDateInterval(
        string $startDate,
        string $endDate,
        ?DateInterval $interval = null,
        string $format = 'Y-m-d'
    ): DatePeriod {
        $interval = $interval ?? new DateInterval('P1D');

        return new DatePeriod(
            Carbon::createFromFormat($format, $startDate),
            $interval,
            Carbon::createFromFormat($format, $endDate)->addDay()
        );
    }
}
