<?php

namespace App\Charts\Homepage;

use App\Charts\Chart;
use App\Helpers\Date;
use App\Models\Admin\Organization\Organization;
use App\Repositories\Documents\Shipment\PackingLists\PackingListProductRepository;
use ArielMejiaDev\LarapexCharts\AreaChart;
use Carbon\CarbonPeriod;

/**
 * График средней суммы продажи.
 */
class AverageSalesChart extends Chart
{
    /**
     * @inheritDoc
     */
    public function build(): AreaChart
    {
        $chart = $this->chart->areaChart()
            ->setTitle(__('charts.sales.average_sales'))
            ->setToolbar(true)
            ->setGrid()
            ->setMarkers([], 3, 5)
            ->setHeight(350)
            ->setStroke(1);

        foreach ($this->data['values'] as $organization) {
            $chart->addData($organization['name'], $organization['sum']);
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
            $values[$key]['name'] = $organization->legal_form_type . ' ' . $organization->name;

            foreach ($periods as $period) {
                if ($period['start'] === $period['end']) {
                    $label = $period['start']
                        ->copy()
                        ->format('d.m.y');
                } else {
                    $label = $period['start']
                            ->copy()
                            ->format('d.m.y')
                        . ' - '
                        . $period['end']
                            ->copy()
                            ->format('d.m.y');
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
                    $sum / CarbonPeriod::create(
                        $period['start'],
                        $period['end']
                    )->count(),
                    2
                );
            }
        }

        return compact('labels', 'values');
    }
}
