<?php

namespace App\Http\Controllers\Classifier;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifier\Bank\StoreBankRequest;
use App\Http\Requests\Classifier\Bank\UpdateBankRequest;
use App\Models\Classifier\Bank;
use Illuminate\View\View;
use App\Services\Classifier\BankService;
use Illuminate\Http\RedirectResponse;

/**
 * Контроллер классификатора банков.
 */
class BankController extends CoreController
{
    /**
     * @var BankService
     */
    private $service;

    /**
     * @param BankService $service
     */
    public function __construct(BankService $service)
    {
        $this->service = $service;
        $this->authorizeResource(Bank::class, 'bank');
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('classifiers.banks.index', $this->service->getIndexData());
    }

    /**
     * @param StoreBankRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreBankRequest $request): RedirectResponse
    {
        $this->service->create(
            $request->validated()['bank']
        );

        return $this->successRedirect();
    }

    /**
     * @param Bank              $bank
     * @param UpdateBankRequest $request
     *
     * @return RedirectResponse
     */
    public function update(Bank $bank, UpdateBankRequest $request): RedirectResponse
    {
        $this->service->update(
            $bank,
            $request->validated()['banks']
        );

        return $this->successRedirect();
    }
}
