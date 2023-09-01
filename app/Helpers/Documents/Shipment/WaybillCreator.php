<?php

namespace App\Helpers\Documents\Shipment;

use App\Helpers\Documents\Creator;
use App\Models\Classifiers\Nomenclature\Products\EndProduct;
use App\Models\Documents\Shipment\PackingLists\PackingListProduct;

class WaybillCreator extends Creator
{
    /**
     * @return object
     */
    public function getData()
    {
        if (!(count($this->document->data))) {
            return null;
        }

        $invoiceForPayment = $this->document->production->first()->invoiceForPayment;

        $productsOnPage = $this->getProductionOnPage();

        return (object)[
            'organization' => (object)[
                'supplier' => $this->getSupplierField(),
                'shipper' => $this->getShipperField(),
                'shipping_address' => $this->getShippingAddress(),
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

    /**
     * @return string
     */
    protected function getBuyerField()
    {
        $contractor = $this->document->contractor;

        $registered = $this->getContractorRegisteredAddress($contractor);

        $bank = $this->getContractorAccountDetails($this->document->contractorBankAccountDetail);

        return $this->getContractorFullName($contractor)
            . ', ИНН '
            . $contractor->INN
            . ', '
            . $registered->get('index')
            . ', '
            . $registered->get('address')
            . ', тел.: '
            . $contractor->contacts
            . ', р/с '
            . $bank->payment_account
            . ', в банке '
            . $bank->name
            . ', БИК '
            . $bank->BIC
            . ', к/с '
            . $bank->correspondent_account;
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
            . $endProduct->okpd2->code;
    }
}
