<?php

namespace App\Helpers\Documents\Shipment;

use App\Helpers\Documents\Creator;
use Illuminate\Support\Str;

class PackingListCreator extends Creator
{
    /**
     * @return object
     */
    public function getData()
    {
        $invoiceForPayment = $this->document->production->first()->invoiceForPayment;

        $productsOnPage = $this->getProductionOnPage();

        return (object) [
            'organization' => (object)[
                'supplier' => $this->getSupplierField(),
                'shipper' => $this->getShipperField(),
                'okpo' => $this->document->organization->OKPO,
            ],
            'contractor' => (object)[
                'buyer' => $this->getBuyerField(),
                'consignee' => $this->getConsigneeField(),
                'delivery_address' => $this->getDeliveryAddressField(),
                'okpo' => $this->document->contractor->OKPO,
            ],
            'basis' => (object)[
                'number' => $invoiceForPayment->number,
                'date' => $invoiceForPayment->date,
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
}
