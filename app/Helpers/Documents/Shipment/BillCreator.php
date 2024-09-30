<?php

namespace App\Helpers\Documents\Shipment;

use App\Helpers\Documents\Creator;
use App\Models\Classifier\Nomenclature\Product\EndProduct;
use App\Models\Documents\Shipment\PackingLists\PackingListProduct;

class BillCreator extends Creator
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

        $organization = $this->document->organization;
        $contactor = $this->document->contractor;

        return (object)[
            'organization' => (object)[
                'shipper' => $this->getShipperField(),
                'name' => $this->getOrganizationFullName($organization),
                'registered' => $this->getOrganizationRegisteredAddress($organization),
                'inn' => $organization->INN,
                'kpp' => $organization->kpp,
            ],
            'contractor' => (object)[
                'consignee' => $this->getConsigneeField(),
                'delivery_address' => $this->getDeliveryAddressField(),
                'name' => $this->getContractorFullName($contactor),
                'registered' => $this->getContractorRegisteredAddress($contactor),
                'inn' => $contactor->INN,
                'kpp' => $contactor->kpp,
            ],
            'packing_list' => (object)[
                'number' => $this->document->number,
                'date' => $this->document->date
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
    protected function getShipperField()
    {
        $organization = $this->document->organization;

        $placeOfBusiness = $this->document->organizationPlaceOfBusiness;

        return $this->getOrganizationFullName($organization)
            . ', '
            . $placeOfBusiness->index
            . ', '
            . $placeOfBusiness->address;
    }

    /**
     * @return string
     */
    protected function getConsigneeField()
    {
        $contractor = $this->document->contractor;

        $placeOfBusiness = $this->document->contractorPlaceOfBusiness;

        return $this->getContractorFullName($contractor)
            . ', '
            . $placeOfBusiness->index
            . ', '
            . $placeOfBusiness->address;
    }

    /**
     * @param EndProduct         $endProduct
     * @param PackingListProduct $packingListProduct
     *
     * @return string
     */
    protected function getProductFullName(EndProduct $endProduct, PackingListProduct $packingListProduct)
    {
        $registrationNumber = $endProduct->registrationNumber->number ?? '';
        return $endProduct->full_name
            . ' '
            . $registrationNumber
            . ' код ОКПД2 '
            . $endProduct->okpd2->code
            . ' '
            . '(' . $packingListProduct->series . ')';
    }
}
