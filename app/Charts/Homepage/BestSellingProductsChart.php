<?php

namespace App\Charts\Homepage;

use App\Charts\Chart;
use App\Models\Documents\Shipment\PackingLists\PackingListProduct;
use ArielMejiaDev\LarapexCharts\PieChart;
use DB;

/**
 * График наиболее продаваемой продукции.
 */
class BestSellingProductsChart extends Chart
{
    private const PRODUCTION_QUANTITY = 10;

    /**
     * @inheritDoc
     */
    public function build(): PieChart
    {
        return $this->chart->pieChart()
            ->setTitle(
                __(
                    'charts.products.best_selling',
                    ['count' => self::PRODUCTION_QUANTITY]
                )
            )
            ->addData($this->data['values'])
            ->setToolbar(true)
            ->setHeight(350)
            ->setLabels($this->data['labels']);
    }

    /**
     * @inheritDoc
     */
    public function isEmpty(): bool
    {
        return !$this->data;
    }

    /**
     * @inheritDoc
     */
    protected function getData(): array
    {
        $data = [];

        $products = PackingListProduct::select(
            [
                'product_id',
                DB::raw('SUM(price * quantity) as sum')
            ]
        )
            ->whereBetween(
                'created_at',
                [$this->fromDate, $this->toDate]
            )
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
                $productName = $product
                    ->productCatalog
                    ->endProduct
                    ->short_name;

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
