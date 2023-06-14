<?php

namespace App\Charts;

use App\Models\Documents\Shipment\PackingLists\PackingListProduct;
use ArielMejiaDev\LarapexCharts\DonutChart;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use ArielMejiaDev\LarapexCharts\PieChart;
use DB;

class BestSellingProductsChart
{
    private const PRODUCTION_QUANTITY = 10;

    protected $chart;

    private $fromDate;

    private $toDate;

    public function __construct(LarapexChart $chart, string $fromDate, string $toDate)
    {
        $this->chart = $chart;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
    }

    /**
     * @return DonutChart
     */
    public function build(): DonutChart
    {
        $data = $this->getData();

        return $this->chart->donutChart()
            ->setTitle(
                __(
                    'charts.products.best_selling',
                    ['count' => self::PRODUCTION_QUANTITY]
                )
            )
            ->addData($data['values'] ?? [])
            ->setToolbar(true)
            ->setHeight(350)
            ->setLabels($data['labels'] ?? []);
    }

    /**
     * @return array
     */
    private function getData()
    {
        $data = [];

        $products = PackingListProduct::select(
            [
                'product_id',
                DB::raw('SUM(price * quantity) as sum')
            ]
        )
            ->whereBetween('created_at', [$this->fromDate, $this->toDate])
            ->withoutTrashed()
            ->with(
                [
                    'productCatalog' => function ($query) {
                        $query->with(
                            [
                                'endProduct:id,full_name,short_name'
                            ]
                        );
                    },
                ]
            )
            ->orderBy('sum', 'desc')
            ->take(self::PRODUCTION_QUANTITY)
            ->groupBy('product_id')
            ->get()
            ->map(function ($product) {
                $productName = $product->productCatalog->endProduct->short_name;
                return [
                    'value' => $product->sum,
                    'label' => $productName,
                ];
            });

        foreach ($products as $product) {
            $data['values'][] = $product['value'];
            $data['labels'][] = $product['label'];
        }

        return $data;
    }
}
