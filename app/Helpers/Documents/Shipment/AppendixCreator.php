<?php

namespace App\Helpers\Documents\Shipment;

use App\Helpers\Documents\Creator;
use App\Models\Classifiers\Nomenclature\Products\EndProduct;
use App\Models\Documents\Shipment\PackingLists\PackingListProduct;

class AppendixCreator extends Creator
{
    protected $countProductsOnPages = [6, 8];

    /**
     * @return object
     */
    public function getData()
    {
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

        $registered = $this->getOrganizationRegisteredAddress($organization);

        return $this->getOrganizationFullName($organization)
            . ', '
            . $registered->get('index')
            . ', '
            . $registered->get('address');
    }

    /**
     * @return string
     */
    protected function getBuyerField()
    {
        $contractor = $this->document->contractor;

        $registered = $this->getContractorRegisteredAddress($contractor);

        return $this->getContractorFullName($contractor)
            . ', '
            . $registered->get('index')
            . ', '
            . $registered->get('address');
    }

    /**
     * @param EndProduct         $endProduct
     * @param PackingListProduct $packingListProduct
     *
     * @return string
     */
    protected function getProductFullName(EndProduct $endProduct, PackingListProduct $packingListProduct)
    {
        return $endProduct->full_name
            . ' '
            . $endProduct->registrationNumber->number
            . ' код ОКПД2 '
            . $endProduct->okpd2->code;
    }
}