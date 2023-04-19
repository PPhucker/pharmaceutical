<?php

namespace App\Helpers\Documents;

use App\Models\Admin\Organizations\Organization;
use App\Models\Contractors\Contractor;
use App\Models\Documents\InvoicesForPayment\InvoiceForPayment;
use App\Repositories\Admin\Organizations\OrganizationRepository;
use App\Repositories\Contractors\ContractorRepository;
use App\Repositories\Documents\InvoicesForPayment\InvoiceForPaymentProductRepository;
use Illuminate\Support\Str;

class InvoiceForPaymentCreator extends Creator
{
    /**
     * @var InvoiceForPayment
     */
    private $invoiceForPayment;

    public function __construct(InvoiceForPayment $invoiceForPayment)
    {
        $this->invoiceForPayment = $invoiceForPayment;
    }

    /**
     * @return object
     */
    public function getData()
    {
        $organizationAccountDetails = $this->getOrganizationAccountDetails(
            $this->invoiceForPayment->organizationBankAccountDetail
        );
        $contractorAccountDetails = $this->getContractorAccountDetails(
            $this->invoiceForPayment->contractorBankAccountDetail
        );

        $organization = $this->invoiceForPayment->organization;
        $contractor = $this->invoiceForPayment->contractor;

        $production = $this->getProduction();

        return (object)
        [
            'invoice' => $this->getInvoiceForPayment($this->invoiceForPayment),
            'production' => $production,
            'total' => $this->getTotal(),
            'contractor' =>
                (object)[
                    'bank' => $contractorAccountDetails,
                    'buyer' => $this->getBuyerField($contractor),
                    'consignee' => $this->getConsigneeField($contractor),
                ],
            'organization' =>
                (object)[
                    'bank' => $organizationAccountDetails,
                    'INN' => $organization->INN,
                    'kpp' => $organization->kpp,
                    'legal_form' => (object)[
                        'short' => $organization->legalForm->abbreviation,
                        'full' => $organization->legalForm->decoding,
                    ],
                    'name' => $organization->name,
                    'supplier' => $this->getSupplierField($organization),
                    'shipper' => $this->getShipperField($organization),
                ],
            'director' => $this->invoiceForPayment->director,
            'bookkeeper' => $this->invoiceForPayment->bookkeeper,
        ];
    }

    /**
     * @return array
     */
    public function getProduction()
    {
        $production = [];

        foreach (
            (new InvoiceForPaymentProductRepository())
                ->getInvoiceForPaymentProduction($this->invoiceForPayment->id) as $key => $invoiceProduct
        ) {
            $endProduct = $invoiceProduct->productCatalog->endProduct;
            $production[] = (object)[
                'key' => $key + 1,
                'full_name' => $endProduct->full_name
                    . ' '
                    . $endProduct->registrationNumber->number
                    . ' ОКПД2 '
                    . $endProduct->okpd2->code,
                'quantity' => $invoiceProduct->quantity,
                'okei' => $endProduct->okei->symbol,
                'price' => $this->numberFormat($invoiceProduct->price),
                'sum' => $this->numberFormat(
                    round($invoiceProduct->price * $invoiceProduct->quantity, 2)
                ),
            ];
        }

        return $production;
    }

    /**
     * @return object
     */
    public function getTotal()
    {
        $total = 0;
        $nds = 0;

        foreach (
            $invoiceProduction = $this->invoiceForPayment->production()->withoutTrashed()->get() as $invoiceProduct
        ) {
            $sum = $invoiceProduct->price * $invoiceProduct->quantity;
            $total += $sum;
            $nds += round($sum * $invoiceProduct->nds, 2);
        }

        return (object)[
            'numeric' => $this->numberFormat($total),
            'word' => Str::sumInWords($total, self::RUBLES, self::COPECKS),
            'nds' => (object)[
                'sum' => $this->numberFormat($nds),
                'persent' => $invoiceProduction->first()->nds * 100,
            ],
        ];
    }

    /**
     * @param Contractor $contractor
     *
     * @return string
     */
    protected function getBuyerField(Contractor $contractor)
    {
        $registered = (new ContractorRepository())->getRegisteredAddress($contractor->id);

        return $contractor->legalForm->abbreviation
            . ' '
            . $contractor->name
            . ', ИНН '
            . $contractor->INN
            . ', КПП '
            . $contractor->kpp
            . ', '
            . $registered->get('index')
            . ', '
            . $registered->get('address')
            . ', тел.: '
            . $contractor->contacts;
    }

    /**
     * @param Contractor $contractor
     *
     * @return string
     */
    protected function getConsigneeField(Contractor $contractor)
    {
        $placeOfBusiness = $this->invoiceForPayment->contractorPlaceOfBusiness;

        return $contractor->legalForm->abbreviation
            . ' '
            . $contractor->name
            . ', ИНН '
            . $contractor->INN
            . ', КПП '
            . $contractor->kpp
            . ', '
            . $placeOfBusiness->index
            . ', '
            . $placeOfBusiness->address
            . ', тел.: '
            . $contractor->contacts;
    }

    /**
     * @param Organization $organization
     *
     * @return string
     */
    protected function getSupplierField(Organization $organization)
    {
        $registered = (new OrganizationRepository())->getRegisteredAddress($organization->id);

        return $organization->legalForm->abbreviation
            . ' '
            . $organization->name
            . ', ИНН '
            . $organization->INN
            . ', КПП '
            . $organization->kpp
            . ', '
            . $registered->get('index')
            . ', '
            . $registered->get('address')
            . ', тел.: '
            . $organization->contacts;
    }

    /**
     * @param Organization $organization
     *
     * @return string
     */
    protected function getShipperField(Organization $organization)
    {
        $organizationPlaceOfBusiness = $this->invoiceForPayment->organizationPlaceOfBusiness;

        return $organization->legalForm->abbreviation
            . ' '
            . $organization->name
            . ', ИНН '
            . $organization->INN
            . ', КПП '
            . $organization->kpp
            . ', '
            . $organizationPlaceOfBusiness->index
            . ', '
            . $organizationPlaceOfBusiness->address
            . ', тел.: '
            . $organization->contacts;
    }
}
