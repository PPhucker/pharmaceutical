<?php

namespace App\Charts;

use App\Helpers\Date;
use App\Repositories\Documents\Shipment\PackingLists\PackingListProductRepository;
use App\Repositories\Documents\Shipment\PackingLists\PackingListRepository;
use ArielMejiaDev\LarapexCharts\AreaChart;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Admin\Organizations\Organization;
use Carbon\CarbonPeriod;

class AverageSalesChart
{
    protected $chart;
    private $toDate;
    private $fromDate;

    public function __construct(LarapexChart $chart, string $fromDate, string $toDate)
    {
        $this->chart = $chart;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
    }

    public function build(): AreaChart
    {
        $data = $this->getData();

        $chart = $this->chart->areaChart()
            ->setTitle(__('charts.sales.average_sales'))
            ->setToolbar(true)
            ->setGrid()
            ->setMarkers([], 3, 5)
            ->setHeight(350)
            ->setStroke(1);

        foreach ($data['values'] as $organization) {
            $chart->addData($organization['name'], $organization['sum']);
        }

        $chart->setXAxis($data['labels']);

        return $chart;
    }

    /**
     * @return array
     */
    private function getData()
    {
        $labels = [];
        $values = [];

        $periods = Date::period($this->fromDate, $this->toDate);

        $organizations = Organization::select(
            [
                'id',
                'name',
                'legal_form_type',
            ]
        )
            ->withoutTrashed()
            ->get();

        foreach ($organizations as $key => $organization) {
            $values[$key]['name'] = $organization->legal_form_type
                . ' '
                . $organization->name;

            foreach ($periods as $period) {
                if ($period['start'] === $period['end']) {
                    $label = $period['start']->copy()->format('d.m.y');
                } else {
                    $label = $period['start']->copy()->format('d.m.y')
                        . ' - '
                        . $period['end']->copy()->format('d.m.y');
                }

                $sum = (new PackingListProductRepository())
                    ->getSumByPeriod(
                        $organization->id,
                        $period
                    );

                if ($key === 0) {
                    $labels[] = $label;
                }

                $values[$key]['sum'][] = round(
                    $sum / CarbonPeriod::create($period['start'], $period['end'])->count(),
                    2
                );
            }
        }

        return compact('labels', 'values');
    }
}
