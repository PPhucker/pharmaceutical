<?php

namespace App\Charts\Homepage;

use App\Charts\Chart;
use App\Helpers\Date;
use App\Repositories\Contractors\ContractorRepository;
use App\Repositories\Documents\Shipment\PackingLists\PackingListProductRepository;
use ArielMejiaDev\LarapexCharts\BarChart;

/**
 * График суммы продаж по контрагентам.
 */
class BestSalesToContractorsChart extends Chart
{
    private const CONTRACTORS_QUANTITY = 5;

    /**
     * @inheritDoc
     */
    public function build(): BarChart
    {
        $chart = $this->chart->barChart()
            ->setTitle(
                __(
                    'charts.contractors.sum',
                    ['count' => self::CONTRACTORS_QUANTITY]
                )
            )
            ->setToolbar(true)
            ->setGrid()
            ->setStroke(1)
            ->setHeight(350)
            ->setMarkers([], 3, 5);

        foreach ($this->data['values'] as $contractor) {
            $chart->addData($contractor['name'], $contractor['sum']);
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

        $contractors = (new ContractorRepository())
            ->getCustomersForPeriodBySales(
                [$this->fromDate, $this->toDate],
                self::CONTRACTORS_QUANTITY
            );

        foreach ($contractors as $key => $contractor) {
            $values[$key]['name'] = $contractor->legal_form_type . ' ' . $contractor->name;

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
                    ->getSaleSumToContractorByPeriod(
                        $contractor->id,
                        $period
                    );

                if ($key === 0) {
                    $labels[] = $label;
                }

                $values[$key]['sum'][] = $sum;
            }
        }

        return compact('labels', 'values');
    }
}
