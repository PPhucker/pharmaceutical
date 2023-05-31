<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class Date
{
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
}
