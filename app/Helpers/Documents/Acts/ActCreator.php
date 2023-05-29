<?php

namespace App\Helpers\Documents\Acts;

use App\Helpers\Documents\Creator;
use App\Models\Classifiers\Nomenclature\Services\Service;
use App\Repositories\Documents\Acts\ActServiceRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ActCreator extends Creator
{
    protected $countProductsOnPages = [6, 6];

    /**
     * @return object
     */
    public function getData()
    {
        $productsOnPage = $this->getProductionOnPage();

        return (object)[
            'header' => $this->getHeader(),
            'organization' => (object)[
                'performer' => $this->getPerformerField(),
            ],
            'contractor' => (object)[
                'customer' => $this->getCustomerField(),
            ],
            'pages' => $productsOnPage->pages,
            'total' => $productsOnPage->total,
            'total_sum' => $this->getTotalSumField(),
        ];
    }

    /**
     * @return string
     */
    public function getHeader()
    {
        $date = Str::dateInWords(
            Carbon::create($this->document->date)->format('Y-m-d'),
            '-',
            ' '
        );

        return 'Акт'
            . ' № '
            . $this->document->number
            . ' от '
            . $date;
    }

    /**
     * @return string
     */
    public function getPerformerField()
    {
        $performer = $this->document->organization;

        return $performer->legalForm->decoding
            . ' '
            . $performer->name;
    }

    /**
     * @return string
     */
    public function getCustomerField()
    {
        $customer = $this->document->contractor;

        return $customer->legalForm->decoding
            . ' '
            . $customer->name;
    }

    /**
     * Получение полной информации о продукте.
     *
     * @return object
     */
    protected function getProduct(int $id)
    {
        $service = (new ActServiceRepository())->getFullInfo($id);

        $priceWithoutNds = round(
            $service->price - $service->price * $service->nds,
            2
        );

        $sum = $service->quantity * $service->price;
        $sumWithoutNds = $service->quantity * $priceWithoutNds;

        return (object)[
            'name' => $this->getServiceFullName($service->service),
            'okei' => (object)[
                'symbol' => $service->service->okei->symbol
            ],
            'quantity' => $service->quantity,
            'price' => $service->price,
            'price_without_nds' => $priceWithoutNds,
            'nds' => $service->nds * 100 . '%',
            'sum' => $sum,
            'sum_without_nds' => $sumWithoutNds,
            'sum_nds' => $sum - $sumWithoutNds,
            'count_in_place' => 1,
            'count_places' => 1,
        ];
    }

    /**
     * @param Service $service
     *
     * @return string
     */
    public function getServiceFullName(Service $service)
    {
        $date = Str::dateInWords(
            Carbon::create($this->document->date)->format('Y-m-d'),
            '-',
            ' ',
            false,
            false,
            true,
            true
        );

        return $service->name
            . ' за '
            . $date;
    }
}
