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
     *
     * @return Collection
     */
    public static function filter(Request $request)
    {
        $fromDate = $request->input('fromDate')
            ? Carbon::create($request->input('fromDate'))
            : Carbon::now()->startOfWeek();

        $toDate = $request->input('toDate')
            ? Carbon::create($request->input('toDate'))
            : Carbon::now()->endOfWeek();

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
