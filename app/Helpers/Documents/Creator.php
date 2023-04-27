<?php

namespace App\Helpers\Documents;

use App\Models\Admin\Organizations\BankAccountDetail as OrganizationAccount;
use App\Models\Contractors\BankAccountDetail as ContractorAccount;
use App\Models\Documents\InvoicesForPayment\InvoiceForPayment;
use App\Repositories\Admin\Organizations\OrganizationRepository;
use App\Repositories\Contractors\ContractorRepository;
use App\Repositories\Documents\Shipment\PackingLists\PackingListProductRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Creator
{
    protected const RUBLES = ['рубль', 'рубля', 'рублей'];

    protected const COPECKS = ['копейка', 'копейки', 'копеек'];

    /**
     * Массив полей "итого" для каждой страницы документа.
     */
    protected const TOTAL_FIELDS_ON_PAGE = [
        'count_places' => 0,
        'quantity' => 0,
        'sum_without_nds' => 0,
        'sum_nds' => 0,
        'sum' => 0,
    ];

    /**
     * Продукция на каждой странице документа.
     */
    protected const PRODUCTS_ON_PAGE = [
        'production' => [],
        'total' => self::TOTAL_FIELDS_ON_PAGE,
    ];

    /**
     * Кол-во продукции на каждой странице документа.
     */
    protected const COUNT_PRODUCTS_ON_PAGES = [2, 6];

    /**
     * Поля для форматирования.
     */
    protected const FIELDS_FOR_FORMAT = [
        'price',
        'price_without_nds',
        'sum',
        'sum_without_nds',
        'sum_nds',
    ];

    /**
     * @var mixed
     */
    protected $document;
    /**
     * @var array
     */
    protected $pages;
    /**
     * @var array
     */
    protected $total_on_pages;

    public function __construct($document)
    {
        $this->document = $document;
        $this->pages = [];
        $this->total_on_pages = [];
    }

    /**
     * @return string
     */
    public function getTotalSumField()
    {
        $total = 0;

        foreach ($this->document->production as $product) {
            $total += $product->quantity * $product->price;
        }

        return Str::sumInWords($total, self::RUBLES, self::COPECKS);
    }

    /**
     * @param InvoiceForPayment $invoiceForPayment
     *
     * @return object
     */
    protected function getInvoiceForPayment(InvoiceForPayment $invoiceForPayment)
    {
        $date = Str::dateInWords(
            Carbon::create($invoiceForPayment->date)->format('Y-m-d'),
            '-',
            ' '
        );

        return (object)[
            'date' => $date,
            'number' => $invoiceForPayment->number,
        ];
    }

    /**
     * @return string
     */
    protected function getShipperField()
    {
        $organization = $this->document->organization;

        $placeOfBusiness = $this->document->organizationPlaceOfBusiness;

        $bank = $this->getOrganizationAccountDetails($this->document->organizationBankAccountDetail);

        return $organization->legalForm->abbreviation
            . ' '
            . $organization->name
            . ', ИНН '
            . $organization->INN
            . ', '
            . $placeOfBusiness->index
            . ', '
            . $placeOfBusiness->address
            . ', тел.: '
            . $organization->contacts
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
     * @param OrganizationAccount $account
     *
     * @return object
     */
    protected function getOrganizationAccountDetails(OrganizationAccount $account)
    {
        $bank = $account->bankClassifier;

        return (object)
        [
            'name' => $bank->name,
            'BIC' => $bank->BIC,
            'correspondent_account' => $bank->correspondent_account,
            'payment_account' => $account->payment_account,
        ];
    }

    /**
     * @return string
     */
    protected function getSupplierField()
    {
        $organization = $this->document->organization;

        $registered = (new OrganizationRepository())
            ->getRegisteredAddress($organization->id);

        $bank = $this->getOrganizationAccountDetails($this->document->organizationBankAccountDetail);

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
            . $organization->contacts
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
     * @return string
     */
    protected function getConsigneeField()
    {
        $contractor = $this->document->contractor;

        $placeOfBusiness = $this->document->contractorPlaceOfBusiness;

        $bank = $this->getContractorAccountDetails($this->document->contractorBankAccountDetail);

        return $contractor->legalForm->abbreviation
            . ' '
            . $contractor->name
            . ', ИНН '
            . $contractor->INN
            . ', '
            . $placeOfBusiness->index
            . ', '
            . $placeOfBusiness->address
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
     * @param ContractorAccount $account
     *
     * @return object
     */
    protected function getContractorAccountDetails(ContractorAccount $account)
    {
        $bank = $account->bankClassifier;

        return (object)
        [
            'name' => $bank->name,
            'BIC' => $bank->BIC,
            'correspondent_account' => $bank->correspondent_account,
            'payment_account' => $account->payment_account,
        ];
    }

    /**
     * @return string
     */
    protected function getBuyerField()
    {
        $contractor = $this->document->contractor;

        $registered = (new ContractorRepository())
            ->getRegisteredAddress($contractor->id);

        $bank = $this->getContractorAccountDetails($this->document->contractorBankAccountDetail);

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
     * @return string
     */
    protected function getDeliveryAddressField()
    {
        $deliveryAddress = $this->document->contractorPlaceOfBusiness;

        return $deliveryAddress->index
            . ', '
            . $deliveryAddress->address;
    }

    /**
     * Разбиение полной информации о продукции по страницам документа.
     *
     * @return object
     */
    protected function getProductionOnPage()
    {
        foreach (self::COUNT_PRODUCTS_ON_PAGES as $page => $count) {
            $this->pages[$page] = self::PRODUCTS_ON_PAGE;
        }

        $pageKey = 0;

        foreach ($this->document->production as $productKey => $product) {
            $i = $productKey + 1;

            /**
             * Если порядковый номер продукта меньше или равен допустимому кол-ву продукции на странице документа.
             */
            if ($i <= self::COUNT_PRODUCTS_ON_PAGES[$pageKey]) {
                $this->pages[$pageKey]['production'][$i] = $this->getProduct($product->id);
            }

            /**
             * Если существует следующая страница и порядковый номер продукта больше или равен
             * допустимому кол-ву продукции на странице документа.
             */
            if (isset($this->pages[$pageKey + 1]) && $i >= self::COUNT_PRODUCTS_ON_PAGES[$pageKey]) {
                $pageKey++;
            }
        }

        /**
         * Если существует пустая страница, удаляем ее.
         */
        foreach ($this->pages as $key => $page) {
            if (count($page['production']) < 1) {
                unset($this->pages[$key]);
            }
        }

        $this->calculateTotalsForPages();
        $this->formatFields();

        return (object)[
            'pages' => $this->pages,
            'total' => $this->total_on_pages,
        ];
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

        $percent = 100 + $product->nds * 100;

        $priceWithoutNds = round(
            $product->price * 100 / $percent,
            2
        );

        $sum = $product->quantity * $product->price;
        $sumWithoutNds = $product->quantity * $priceWithoutNds;

        $bestBeforeDate = $this->getBestBeforeDate(
            $product->series,
            $endProduct->best_before_date
        );

        return (object)[
            'full_name' => $endProduct->full_name
                . ' код ОКПД2 '
                . $endProduct->okpd2->code,
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
        ];
    }

    /**
     * Возвращает дату окончания срока годности продукта.
     *
     * @param string $series
     * @param int    $bestBeforeDateProduct
     *
     * @return string
     */
    private function getBestBeforeDate(string $series, int $bestBeforeDateProduct)
    {
        $seriesMonth = mb_substr($series, -4, 2);
        $seriesYear = mb_substr($series, -2, 2);

        $seriesDate = Carbon::createFromFormat('d.m.y', "01.$seriesMonth.$seriesYear");

        return $seriesDate
            ->addMonths($bestBeforeDateProduct)
            ->format('d.m.Y');
    }

    /**
     * Вычисление "итого" для каждой страницы.
     *
     * @return void
     */
    private function calculateTotalsForPages()
    {
        $this->total_on_pages = self::TOTAL_FIELDS_ON_PAGE;

        foreach ($this->pages as $pageKey => $page) {
            foreach ($page['production'] as $product) {
                foreach ($page['total'] as $key => $total) {
                    $page['total'][$key] += $product->{$key};
                    $this->total_on_pages[$key] += $product->{$key};
                }
            }
            $this->pages[$pageKey] = $page;
        }
    }

    /**
     * Форматирование вывода полей документа.
     *
     * @return void
     */
    private function formatFields()
    {
        foreach ($this->pages as $pageKey => $page) {
            foreach ($page['production'] as $product) {
                foreach ($product as $key => $item) {
                    if (in_array($key, self::FIELDS_FOR_FORMAT, true)) {
                        $product->{$key} = $this->numberFormat($item);
                    }
                }
            }
            foreach ($page['total'] as $key => $item) {
                if (in_array($key, self::FIELDS_FOR_FORMAT, true)) {
                    $this->pages[$pageKey]['total'][$key] = $this->numberFormat($item);
                }
            }
        }

        foreach ($this->total_on_pages as $key => $item) {
            if (in_array($key, self::FIELDS_FOR_FORMAT, true)) {
                $this->total_on_pages[$key] = $this->numberFormat($item);
            }
        }
    }

    /**
     * Преобразование числа в формат, необходимый для документов.
     *
     * @param $number
     *
     * @return string
     */
    protected function numberFormat($number)
    {
        return number_format($number, 2, ',', ' ');
    }

    /**
     * @return string
     */
    protected function getCountPlacesField()
    {
        $total = 0;
        foreach ($this->document->production as $product) {
            $countInPlace = $product->productCatalog->getQuantityInAggregationType('sscc01');
            $countPlaces = $product->quantity / $countInPlace;
            $total += $countPlaces;
        }
        return Str::sumInWords($total);
    }

    /**
     * @return string
     */
    protected function getCountProductionField()
    {
        return Str::sumInWords(count($this->document->production));
    }
}
