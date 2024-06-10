<?php

namespace App\Http\Controllers;

use App\Charts\Homepage\AverageCountSalesChart;
use App\Charts\Homepage\AverageSalesChart;
use App\Charts\Homepage\BestSalesToContractorsChart;
use App\Charts\Homepage\BestSellingProductsChart;
use App\Helpers\DateHelper;
use App\Models\Admin\Organization\Organization;
use App\Models\Auth\User;
use App\Models\Classifier\Nomenclature\Product\EndProduct;
use App\Models\Contractor\Contractor;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
 * Контроллер домашней страницы.
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     *
     * @return View
     */
    public function index(Request $request): View
    {
        $request->validate([
            'fromDate' => [
                'nullable',
                'date',
            ],
            'toDate' => [
                'nullable',
                'date',
            ],
        ]);

        /*$*//*date = DateHelper::filter($request, '2 weeks');

        $fromDate = $date->get('fromDate');
        $toDate = $date->get('toDate');

        $larapexChart = new LarapexChart();

        $chartTypes = [
            BestSalesToContractorsChart::class,
            BestSellingProductsChart::class,
            AverageCountSalesChart::class,
            AverageSalesChart::class,
        ];

        $charts = [];

        foreach ($chartTypes as $type) {
            $chart = new $type($larapexChart, $fromDate, $toDate);
            if ($chart->isEmpty()) {
                continue;
            }

            $charts[] = $chart->build();
        }

        $countContractors = Contractor::withoutTrashed()->count();
        $countOrganizations = Organization::withoutTrashed()->count();
        $countUsers = User::withoutTrashed()->count();
        $countProducts = EndProduct::withoutTrashed()->count();*/

        return view(
            'home'/*,
            compact(
                'fromDate',
                'toDate',
                'charts',
                'countContractors',
                'countUsers',
                'countOrganizations',
                'countProducts',
            )*/
        );
    }
}
