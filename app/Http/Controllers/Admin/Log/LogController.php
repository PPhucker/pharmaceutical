<?php

namespace App\Http\Controllers\Admin\Log;

use App\Helpers\DateHelper;
use App\Helpers\ModelHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Logs\LogRequest;
use App\Logging\Logger;
use App\Repositories\Auth\UserRepository;
use Illuminate\Contracts\View\View;

/**
 * Контроллер логов.
 */
class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            [
                'auth',
                'verified',
                'admin',
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
    public function index(LogRequest $request): View
    {
        $validated = $request->validated();

        $date = (new DateHelper())->getDateRange($validated);

        $startDate = $date->get('start_date');
        $endDate = $date->get('end_date');

        $logs = (new Logger())->parse(
            $startDate,
            $endDate,
            $validated
        )->sortByDesc('datetime');

        return view(
            'admin.logs.index',
            [
                'logs' => $logs,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'users' => (new UserRepository())->getAll(),
                'models' => ModelHelper::getModelsWithComments(),
                'actions' => [
                    'create',
                    'update',
                    'destroy',
                    'restore',
                    'attach',
                    'detach',
                ],
            ]
        );
    }
}
