<?php

namespace App\Helpers\Documents;

use App\Repositories\Admin\Organization\OrganizationRepository;
use App\Repositories\Contractor\ContractorRepository;
use App\Repositories\Documents\InvoicesForPayment\InvoiceForPaymentMaterialRepository;
use App\Repositories\Documents\InvoicesForPayment\InvoiceForPaymentProductRepository;
use Illuminate\Support\Str;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Класс для создания печатной формы счета на оплату.
 */
class InvoiceForPaymentCreator extends Creator
{
    /**
     * @inheritDoc
     */
    public function getData(): object
    {
        $organizationAccountDetails = $this->getOrganizationAccountDetails(
            $this->document->organizationBankAccountDetail
        );
        $contractorAccountDetails = $this->getContractorAccountDetails(
            $this->document->contractorBankAccountDetail
        );

        $organization = $this->document->organization;

        if ($this->document->fillinf_type === 'materials') {
            $filling = $this->getMaterials();
        } else {
            $filling = $this->getProduction();
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
     * Получить комплектующие счета на оплату.
     *
     * @return array
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getMaterials(): array
    {
        $materials = [];

        $invoiceForPaymentMaterials = (new InvoiceForPaymentMaterialRepository())
            ->getInvoiceForPaymentMaterials($this->document->id);

        foreach ($invoiceForPaymentMaterials as $key => $invoiceMaterial) {
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

    /**
     * Получить продукцию счета на оплату.
     *
     * @return array
     */
    public function getProduction(): array
    {
        $production = [];

        $invoiceForPaymentProduction = (new InvoiceForPaymentProductRepository())
            ->getInvoiceForPaymentProduction($this->document->id);

        foreach ($invoiceForPaymentProduction as $key => $invoiceProduct) {
            $endProduct = $invoiceProduct->productCatalog->endProduct;
            $registrationNumber = $endProduct->registrationNumber->number ?? '';

            $production[] = (object)[
                'key' => $key + 1,
                'full_name' => $endProduct->full_name
                    . ' '
                    . $registrationNumber
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
     * Получить итоговую сумму.
     *
     * @return object
     */
    public function getTotal(): object
    {
        $total = 0;
        $nds = 0;

        $invoiceProduction = $this->document->production()->withoutTrashed()->get();

        foreach ($invoiceProduction as $invoiceProduct) {
            $sum = $invoiceProduct->price * $invoiceProduct->quantity;
            $total += $sum;
            $nds += round($sum * $invoiceProduct->nds, 2);
        }

        return (object)[
            'numeric' => $this->numberFormat($total),
            'word' => Str::sumInWords(
                $total,
                self::RUBLES,
                self::COPECKS
            ),
            'nds' => (object)[
                'sum' => $this->numberFormat($nds),
                'persent' => $invoiceProduction->first()->nds * 100,
            ],
        ];
    }

    /**
     * Получить поле "Плательщик"
     *
     * @return string
     */
    protected function getBuyerField(): string
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
     * Получить поле "Грузополучатель".
     *
     * @return string
     */
    protected function getConsigneeField(): string
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
     * Получить поле "Поставщик".
     *
     * @return string
     */
    protected function getSupplierField(): string
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
     * Получить поле "Грузооправитель".
     *
     * @return string
     */
    protected function getShipperField(): string
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
}
