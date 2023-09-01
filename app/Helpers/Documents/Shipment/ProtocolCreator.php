<?php

namespace App\Helpers\Documents\Shipment;

use App\Helpers\Documents\Creator;
use App\Models\Classifiers\Nomenclature\Products\EndProduct;
use App\Models\Documents\Shipment\PackingLists\PackingListProduct;
use App\Repositories\Documents\Shipment\PackingLists\PackingListProductRepository;

class ProtocolCreator extends Creator
{
    protected $countProductsOnPages = [4, 6];

    /**
     * @return object
     */
    public function getData()
    {
        if (!(count($this->document->data))) {
            return null;
        }

        $productsOnPage = $this->getProductionOnPage();

        return (object)[
            'organization' => (object)[
                'supplier' => $this->getSupplierField(),
            ],
            'contractor' => (object)[
                'buyer' => $this->getBuyerField(),
            ],
            'pages' => $productsOnPage->pages,
            'total' => $productsOnPage->total,
            'count_production' => $this->getCountProductionField(),
            'count_places' => $this->getCountPlacesField(),
            'total_sum' => $this->getTotalSumField(),
            'storekeeper' => $this->document->storekeeper,
            'bookkeeper' => $this->document->bookkeeper,
            'director' => $this->document->director,
        ];
    }

    /**
     * @return string
     */
    protected function getSupplierField()
    {
        $organization = $this->document->organization;

        return $this->getOrganizationFullName($organization);
    }

    /**
     * @return string
     */
    protected function getBuyerField()
    {
        $contractor = $this->document->contractor;

        return $this->getContractorFullName($contractor);
    }

    /**
     * Получение полной информации о продукте.
     *
     * @return object
     */
    protected function getProduct(int $id)
    {
        $product = (new PackingListProductRepository())->getFullInfo($id);

        $productCatalog = $product->productCatalog;

        $endProduct = $productCatalog->endProduct;

        $countInPlace = $productCatalog->getQuantityInAggregationType('sscc01');

        $unit = $countInPlace > 1 ? 'кор' : $endProduct->okei->symbol;

        $countPlaces = $product->quantity / $countInPlace;

        $priceWithoutNds = round(
            $product->price - $product->price * $product->nds,
            2
        );

        $sum = $product->quantity * $product->price;
        $sumWithoutNds = $product->quantity * $priceWithoutNds;

        $bestBeforeDate = $this->getBestBeforeDate(
            $product->series,
            $endProduct->best_before_date
        );

        $protocolPrices = $this->getProtocolPrices($product, $productCatalog);

        return (object)[
            'full_name' => $this->getProductFullName($endProduct, $product),
            'GTIN' => $productCatalog->GTIN,
            'series' => $product->series,
            'best_before_date' => $bestBeforeDate,
            'okei' => (object)[
                'code' => $endProduct->okei->code,
                'unit' => $unit,
                'symbol' => $endProduct->okei->symbol
            ],
            'international_name' => $endProduct->internationalName->name,
            'count_in_place' => $countInPlace,
            'count_places' => $countPlaces,
            'quantity' => $product->quantity,
            'price' => $product->price,
            'price_without_nds' => $priceWithoutNds,
            'nds' => $product->nds * 100 . '%',
            'sum' => $sum,
            'sum_without_nds' => $sumWithoutNds,
            'sum_nds' => $sum - $sumWithoutNds,
            'protocol_prices' => $protocolPrices,
        ];
    }

    /**
     * @param $product
     * @param $productCatalog
     *
     * @return object
     */
    protected function getProtocolPrices($product, $productCatalog)
    {
        $protocolPrices = (object)[
            'register_price' => null,
            'fact_price_without_nds' => null,
            'fact_price' => null,
            'selling_price' => null,
            'selling_price_without_nds' => null,
            'allowance' => null,
            'allowance_percent' => null,
        ];

        $priceWithoutNds = round(
            $product->price - $product->price * $product->nds,
            2
        );

        if ($product->packingList->organization_id === 1) {
            $registerPriceList = $productCatalog
                ->prices()
                ->where('organization_id', '=', $productCatalog->organization_id)
                ->first();

            if ((int)$product->quantity >= (int)$registerPriceList->trade_quantity) {
                $protocolPrices->register_price = round(
                    $registerPriceList->trade_price
                    - $registerPriceList->trade_price * $registerPriceList->nds,
                    2
                );
            } else {
                $protocolPrices->register_price = round(
                    $registerPriceList->retail_price
                    - $registerPriceList->retail_price * $registerPriceList->nds,
                    2
                );
            }
            $protocolPrices->fact_price = $product->price;
            $protocolPrices->fact_price_without_nds = $priceWithoutNds;
        } else {
            $registerPriceList = $productCatalog
                ->prices()
                ->where('organization_id', '=', 1)
                ->first();

            if ($product->quantity >= $registerPriceList->trade_quantity) {
                $protocolPrices->register_price = round(
                    $registerPriceList->trade_price
                    - $registerPriceList->trade_price * $registerPriceList->nds,
                    2
                );
                $protocolPrices->fact_price = $registerPriceList->trade_price;
            } else {
                $protocolPrices->register_price = round(
                    $registerPriceList->retail_price
                    - $registerPriceList->retail_price * $registerPriceList->nds,
                    2
                );
                $protocolPrices->fact_price = $registerPriceList->retail_price;
            }

            $protocolPrices->fact_price_without_nds = $protocolPrices->register_price;
            $protocolPrices->selling_price = $product->price;
            $protocolPrices->selling_price_without_nds = $priceWithoutNds;

            $protocolPrices->allowance = $protocolPrices->selling_price_without_nds
                - $protocolPrices->fact_price_without_nds;
            $protocolPrices->allowance_percent = round(
                (
                    1 - ($protocolPrices->fact_price_without_nds / $protocolPrices->selling_price_without_nds)
                )
                * 100,
                2
            );
        }

        foreach ($protocolPrices as $key => $price) {
            if ($price) {
                $protocolPrices->{$key} = $this->numberFormat($price);
            }
        }

        if ($protocolPrices->allowance_percent) {
            $protocolPrices->allowance_percent .= '%';
        }

        return $protocolPrices;
    }

    /**
     * @param EndProduct         $endProduct
     * @param PackingListProduct $packingListProduct
     *
     * @return string
     */
    protected function getProductFullName(EndProduct $endProduct, PackingListProduct $packingListProduct)
    {
        $productCatalog = $packingListProduct->productCatalog;

        return $endProduct->full_name
            . ' '
            . $endProduct->registrationNumber->number
            . ' код ОКПД2 '
            . $endProduct->okpd2->code
            . ', '
            . $productCatalog->GTIN;
    }
}
