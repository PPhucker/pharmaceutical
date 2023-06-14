<?php

namespace App\Http\Controllers;

use App\Charts\AverageCountSalesChart;
use App\Charts\AverageSalesChart;
use App\Charts\BestSalesToContractorsChart;
use App\Charts\BestSellingProductsChart;
use App\Charts\ContractorsChart;
use App\Charts\NumberOfContractorsChart;
use App\Helpers\Date;
use App\Models\Admin\Organizations\Organization;
use App\Models\Auth\User;
use App\Models\Classifiers\Nomenclature\Products\EndProduct;
use App\Synchronization\Contractor;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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
     * @return View
     */
    public function index(Request $request)
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

        $date = Date::filter($request, '2 weeks');

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
            $charts[] = (new $type($larapexChart, $fromDate, $toDate))->build();
        }

        $countContractors = \App\Models\Contractors\Contractor::withoutTrashed()->count();
        $countOrganizations = Organization::withoutTrashed()->count();
        $countUsers = User::withoutTrashed()->count();
        $countProducts = EndProduct::withoutTrashed()->count();

        return view(
            'home',
            compact(
                'fromDate',
                'toDate',
                'charts',
                'countContractors',
                'countUsers',
                'countOrganizations',
                'countProducts',
            )
        );
    }
}
