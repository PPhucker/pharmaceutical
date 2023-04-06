<?php

namespace App\Http\Controllers\Classifiers;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Classifiers\Bank\StoreBankRequest;
use App\Http\Requests\Classifiers\Bank\UpdateBankRequest;
use App\Models\Classifiers\Bank;
use App\Repositories\Classifiers\BankRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class BankController extends CoreController
{
    /**
     * @return void
     */
    protected function authorizeActions()
    {
        $this->authorizeResource(Bank::class, 'bank');
    }

    /**
     * @return string
     */
    protected function getRepository()
    {
        return BankRepository::class;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $banks = $this->repository->getAll();

        return view(
            'classifiers.banks.index',
            compact('banks')
        );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBankRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreBankRequest $request)
    {
        $validated = $request->validated()['bank'];

        Bank::create(
            [
                'BIC' => $validated['BIC'],
                'correspondent_account' => $validated['correspondent_account'],
                'name' => $validated['name'],
            ]
        );

        return back()
            ->with(
                'success',
                __('classifiers.banks.actions.create.success'),
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBankRequest $request
     * @param Bank|null         $bank
     *
     * @return RedirectResponse
     */
    public function update(UpdateBankRequest $request, Bank $bank = null)
    {
        $validated = $request->validated();

        foreach ($validated['banks'] as $item) {
            Bank::find($item['original_BIC'])
            ->fill(
                [
                    'BIC' => $item['BIC'],
                    'correspondent_account' => $item['correspondent_account'],
                    'name' => $item['name'],
                ]
            )
                ->save();
        }

        return back()
            ->with(
                'success',
                __('classifiers.banks.actions.update.success')
            );
    }
}
