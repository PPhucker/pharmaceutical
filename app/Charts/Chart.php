<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

abstract class Chart
{
    /**
     * @var LarapexChart
     */
    protected $chart;
    /**
     * Начало временного интервала.
     *
     * @var string
     */
    protected $fromDate;
    /**
     * Конец временного интервала.
     *
     * @var string
     */
    protected $toDate;
    /**
     * Массив данных для построения графика.
     *
     * @var array
     */
    protected $data;

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
        $this->data = $this->getData();
    }

    /**
     * Получить массив данных графика.
     *
     * @return array
     */
    abstract protected function getData(): array;

    /**
     * Массив данных графика пуст.
     *
     * @return bool
     */
    abstract public function isEmpty(): bool;

    /**
     * Возвращает график для отображния.
     *
     * @return mixed
     */
    abstract public function build();
}
