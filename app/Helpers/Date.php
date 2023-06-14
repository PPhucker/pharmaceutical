<?php

namespace App\Helpers;

use Carbon\CarbonInterface;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class Date
{
    private const STEPS = ['1 day', '1 week', '1 month', '1 year'];

    /**
     * Returns the start and end date of the interval.
     *
     * @param Request $request
     * @param string  $type
     *
     * @return Collection
     */
    public static function filter(Request $request, string $type = 'month')
    {
        switch ($type) {
            case 'month':
                $start = Carbon::now()->startOfMonth();
                $end = Carbon::now()->endOfMonth();
                break;
            case 'week':
                $start = Carbon::now()->startOfWeek();
                $end = Carbon::now()->endOfWeek();
                break;
            case '2 weeks':
                $start = Carbon::now()->subWeek()->startOfWeek();
                $end = Carbon::now()->endOfWeek();
                break;
            case 'year':
                $start = Carbon::now()->startOfYear();
                $end = Carbon::now()->endOfYear();
                break;
            default:
                $start = Carbon::now();
                $end = Carbon::now();
                break;
        }

        $fromDate = $request->input('fromDate')
            ? Carbon::create($request->input('fromDate'))
            : $start;

        $toDate = $request->input('toDate')
            ? Carbon::create($request->input('toDate'))
            : $end;

        $fromDate = $fromDate->format('Y-m-d');
        $toDate = $toDate->format('Y-m-d');

        return collect(
            compact(
                'fromDate',
                'toDate'
            )
        );
    }

    /**
     * @param string $fromDate
     * @param string $toDate
     *
     * @return CarbonInterface[]
     */
    public static function period(string $fromDate, string $toDate)
    {
        $period = CarbonPeriod::create($fromDate, $toDate);

        $count = $period->count();

        switch ($count) {
            case in_array($count, range(32, 365), true):
                $interval = '1 week';
                break;
            case $count > 365:
                $interval = '1 month';
                break;
            default:
                $interval = '1 day';
                break;
        }

        $periods = CarbonPeriod::create($fromDate, $interval, $toDate)->toArray();

        $result = [];

        foreach ($periods as $key => $period) {
            $carbon = Carbon::create($period->format('Y-m-d'));
            switch ($interval) {
                case '1 week':
                    $result[$key]['start'] = $carbon->copy()->startOfWeek();
                    $result[$key]['end'] = $carbon->copy()->endOfWeek();
                    break;
                case '1 month':
                    $result[$key]['start'] = $carbon->copy()->startOfMonth();
                    $result[$key]['end'] = $carbon->copy()->endOfMonth();
                    break;
                default:
                    $result[$key]['start'] = $carbon;
                    $result[$key]['end'] = $carbon;
            }
        }

        return $result;
    }
}
