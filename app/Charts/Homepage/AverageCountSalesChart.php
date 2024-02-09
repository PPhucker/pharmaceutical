<?php

namespace App\Charts\Homepage;

use App\Charts\Chart;
use App\Helpers\DateHelper;
use App\Models\Admin\Organization\Organization;
use App\Repositories\Documents\Shipment\PackingLists\PackingListRepository;
use ArielMejiaDev\LarapexCharts\BarChart;

/**
 * График среднего кол-ва продаж.
 */
class AverageCountSalesChart extends Chart
{
    /**
     * @inheritDoc
     */
    public function build(): BarChart
    {
        $chart = $this->chart->barChart()
            ->setTitle(__('charts.sales.average_count'))
            ->setToolbar(true)
            ->setGrid()
            ->setStroke(1)
            ->setHeight(350)
            ->setMarkers([], 3, 5);

        foreach ($this->data['values'] as $organization) {
            $chart->addData($organization['name'], $organization['quantity']);
        }

        $chart->setXAxis($this->data['labels']);

        return $chart;
    }

    /**
     * @inheritDoc
     */
    public function isEmpty(): bool
    {
        return !$this->data['labels'] || !$this->data['values'];
    }

    /**
     * @inheritDoc
     */
    protected function getData(): array
    {
        $labels = [];
        $values = [];

        $periods = DateHelper::period($this->fromDate, $this->toDate);

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
