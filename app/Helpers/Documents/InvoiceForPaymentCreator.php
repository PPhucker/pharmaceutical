<?php

namespace App\Helpers\Documents;

use App\Repositories\Admin\Organizations\OrganizationRepository;
use App\Repositories\Contractors\ContractorRepository;
use App\Repositories\Documents\InvoicesForPayment\InvoiceForPaymentMaterialRepository;
use App\Repositories\Documents\InvoicesForPayment\InvoiceForPaymentProductRepository;
use Illuminate\Support\Str;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class InvoiceForPaymentCreator extends Creator
{

    /**
     * @return object
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getData()
    {
        $organizationAccountDetails = $this->getOrganizationAccountDetails(
            $this->document->organizationBankAccountDetail
        );
        $contractorAccountDetails = $this->getContractorAccountDetails(
            $this->document->contractorBankAccountDetail
        );

        $organization = $this->document->organization;

        switch ($this->document->filling_type) {
            case 'materials':
                $filling = $this->getMaterials();
                break;
            default:
                $filling = $this->getProduction();
                break;
        }

        return (object)
        [
            'invoice' => $this->getInvoiceForPayment($this->document),
            'production' => $filling,
            'total' => $this->getTotal(),
            'contractor' =>
                (object)[
                    'bank' => $contractorAccountDetails,
                    'buyer' => $this->getBuyerField(),
                    'consignee' => $this->getConsigneeField(),
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
                    'supplier' => $this->getSupplierField(),
                    'shipper' => $this->getShipperField(),
                ],
            'director' => $this->document->director,
            'bookkeeper' => $this->document->bookkeeper,
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
                ->getInvoiceForPaymentProduction($this->document->id) as $key => $invoiceProduct
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
            $invoiceProduction = $this->document->production()->withoutTrashed()->get() as $invoiceProduct
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
     * @return string
     */
    protected function getBuyerField()
    {
        $contractor = $this->document->contractor;

        $registered = (new ContractorRepository())
            ->getRegisteredAddress(
                $contractor->id
            );

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
     * @return string
     */
    protected function getConsigneeField()
    {
        $contractor = $this->document->contractor;
        $placeOfBusiness = $this->document->contractorPlaceOfBusiness;

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
     * @return string
     */
    protected function getSupplierField()
    {
        $organization = $this->document->organization;

        $registered = (new OrganizationRepository())
            ->getRegisteredAddress($organization->id);

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
     * @return string
     */
    protected function getShipperField()
    {
        $organization = $this->document->organization;
        $placeOfBusiness = $this->document->organizationPlaceOfBusiness;

        return $organization->legalForm->abbreviation
            . ' '
            . $organization->name
            . ', ИНН '
            . $organization->INN
            . ', КПП '
            . $organization->kpp
            . ', '
            . $placeOfBusiness->index
            . ', '
            . $placeOfBusiness->address
            . ', тел.: '
            . $organization->contacts;
    }

    /**
     * @return array
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getMaterials()
    {
        $materials = [];

        foreach (
            (new InvoiceForPaymentMaterialRepository())->getInvoiceForPaymentMaterials(
                $this->document->id
            ) as $key => $invoiceMaterial
        ) {
            $material = $invoiceMaterial->material;
            $materials[] = (object)[
                'key' => $key + 1,
                'full_name' => $material->name,
                'quantity' => $invoiceMaterial->quantity,
                'price' => $this->numberFormat($invoiceMaterial->price),
                'okei' => $material->okei->symbol,
                'sum' => $this->numberFormat(
                    round($invoiceMaterial->price * $invoiceMaterial->quantity, 2)
                )
            ];
        }
        return $materials;
    }
}
