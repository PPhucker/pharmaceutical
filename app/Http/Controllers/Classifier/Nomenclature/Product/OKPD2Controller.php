<?php

namespace App\Http\Controllers\Classifier\Nomenclature\Product;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifier\Nomenclature\Product\Okpd2\StoreOKPD2Request;
use App\Http\Requests\Classifier\Nomenclature\Product\Okpd2\UpdateOKPD2Request;
use App\Models\Classifier\Nomenclature\Product\OKPD2;
use App\Services\Classifier\Nomenclature\Product\OKPD2Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Контроллер классификатора ОКПД2.
 */
class OKPD2Controller extends CoreController
{
    /**
     * @var OKPD2Service
     */
    private $service;

    /**
     * @param OKPD2Service $service
     */
    public function __construct(OKPD2Service $service)
    {
        $this->service = $service;
        $this->authorizeResource(OKPD2::class, 'okpd2');
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view(
            'classifiers.nomenclature.products.okpd2.index',
            $this->service->getIndexData()
        );
    }

    /**
     * @param StoreOKPD2Request $request
     *
     * @return RedirectResponse
     */
    public function store(StoreOKPD2Request $request): RedirectResponse
    {
        $this->service->create(
            $request->validated()['okpd2']
        );

        return $this->successRedirect();
    }

    /**
     * @param UpdateOKPD2Request $request
     * @param OKPD2              $okpd2
     *
     * @return RedirectResponse
     */
    public function update(UpdateOKPD2Request $request, OKPD2 $okpd2): RedirectResponse
    {
        $this->service->update(
            $okpd2,
            $request->validated()['okpd2']
        );

        return $this->successRedirect();
    }
}
