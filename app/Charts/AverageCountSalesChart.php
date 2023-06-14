<?php

namespace App\Charts;

use App\Helpers\Date;
use App\Models\Admin\Organizations\Organization;
use App\Repositories\Documents\Shipment\PackingLists\PackingListRepository;
use ArielMejiaDev\LarapexCharts\BarChart;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class AverageCountSalesChart
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

    public function build(): BarChart
    {
        $data = $this->getData();
        $chart = $this->chart->barChart()
            ->setTitle(__('charts.sales.average_count'))
            ->setToolbar(true)
            ->setGrid()
            ->setStroke(1)
            ->setHeight(350)
            ->setMarkers([], 3, 5);

        foreach ($data['values'] as $organization) {
            $chart->addData($organization['name'], $organization['quantity']);
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
                    $label = $period['start']->format('d.m.y');
                } else {
                    $label = $period['start']->format('d.m.y') . ' - ' . $period['end']->format('d.m.y');
                }

                $quantity = (new PackingListRepository())->getCountByPeriod($organization->id, $period);

                if ($key === 0) {
                    $labels[] = $label;
                }

                $values[$key]['quantity'][] = $quantity;
            }
        }


        return compact('labels', 'values');
    }
}
