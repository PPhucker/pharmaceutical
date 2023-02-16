<?php

namespace App\Http\Controllers\Admin\Logs;

use App\Helpers\Date;
use App\Helpers\Model;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Logs\LogRequest;
use App\Logging\Logger;
use App\Models\Auth\User;
use Illuminate\Contracts\View\View;

class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            [
                'auth',
                'verified',
                'admin'
            ]
        );
    }

    /**
     * Returns the log page.
     *
     * @param LogRequest $request
     *
     * @return View
     */
    public function index(LogRequest $request)
    {
        $validated = $request->validated();

        $date = Date::filter($request);

        $fromDate = $date->get('fromDate');
        $toDate = $date->get('toDate');

        $logger = Logger::parse($fromDate, $toDate, $validated);

        $logs = $logger->get('parsed');

        $actions = [
            'create',
            'update',
            'destroy',
            'restore'
        ];

        $models = Model::all();

        $users = User::all();

        return view(
            'admin.logs.index',
            compact(
                'logs',
                'actions',
                'models',
                'users',
                'fromDate',
                'toDate'
            )
        );
    }
}
