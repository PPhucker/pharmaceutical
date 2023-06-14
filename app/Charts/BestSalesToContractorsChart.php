<?php

namespace App\Charts;

use App\Helpers\Date;
use App\Repositories\Contractors\ContractorRepository;
use App\Repositories\Documents\Shipment\PackingLists\PackingListProductRepository;
use ArielMejiaDev\LarapexCharts\BarChart;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class BestSalesToContractorsChart
{
    private const CONTRACTORS_QUANTITY = 5;
    private $chart;
    /**
     * @var string
     */
    private $fromDate;
    /**
     * @var string
     */
    private $toDate;

    /**
     * @param LarapexChart $chart
     * @param string       $fromDate
     * @param string       $toDate
     */
    public function __construct(LarapexChart $chart, string $fromDate, string $toDate)
    {
        $this->chart = $chart;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
    }

    /**
     * @return BarChart
     */
    public function build()
    {
        $data = $this->getData();

        $chart = $this->chart->barChart()
            ->setTitle(__('charts.contractors.sum', ['count' => self::CONTRACTORS_QUANTITY]))
            ->setToolbar(true)
            ->setGrid()
            ->setStroke(1)
            ->setHeight(350)
            ->setMarkers([], 3, 5);

        foreach ($data['values'] as $contractor) {
            $chart->addData($contractor['name'], $contractor['sum']);
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

        $contractors = (new ContractorRepository())
            ->getCustomersForPeriodBySales(
                [$this->fromDate, $this->toDate],
                self::CONTRACTORS_QUANTITY
            );

        foreach ($contractors as $key => $contractor) {
            $values[$key]['name'] = $contractor->legal_form_type
                . ' '
                . $contractor->name;

            foreach ($periods as $period) {
                if ($period['start'] === $period['end']) {
                    $label = $period['start']->copy()->format('d.m.y');
                } else {
                    $label = $period['start']->copy()->format('d.m.y')
                        . ' - '
                        . $period['end']->copy()->format('d.m.y');
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
