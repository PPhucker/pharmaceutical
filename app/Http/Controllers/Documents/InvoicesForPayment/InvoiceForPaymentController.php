<?php

namespace App\Http\Controllers\Documents\InvoicesForPayment;

use App\Helpers\Date;
use App\Helpers\Documents\InvoiceForPaymentCreator;
use App\Helpers\File;
use App\Http\Controllers\CoreController;
use App\Http\Requests\Documents\InvoicesForPayment\IndexInvoiceForPaymentRequest;
use App\Http\Requests\Documents\InvoicesForPayment\StoreInvoiceForPaymentRequest;
use App\Http\Requests\Documents\InvoicesForPayment\UpdateInvoiceForPaymentRequest;
use App\Models\Contractors\Contractor;
use App\Models\Documents\InvoicesForPayment\InvoiceForPayment;
use App\Repositories\Admin\Organizations\OrganizationRepository;
use App\Repositories\Classifiers\Nomenclature\Products\ProductCatalogRepository;
use App\Repositories\Documents\InvoicesForPayment\InvoiceForPaymentMaterialRepository;
use App\Repositories\Documents\InvoicesForPayment\InvoiceForPaymentProductRepository;
use App\Repositories\Documents\InvoicesForPayment\InvoiceForPaymentRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class InvoiceForPaymentController extends CoreController
{
    private const FILLING_TYPES = [
        'production' => 'Готовая продукция',
        'materials' => 'Комплектующие',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(IndexInvoiceForPaymentRequest $request)
    {
        $validated = $request->validated();

        $date = Date::filter($request);

        $fromDate = $date->get('fromDate');
        $toDate = $date->get('toDate');

        $filters = [
            'organization_id' => $validated['organization_id'] ?? null,
            'fromDate' => $fromDate,
            'toDate' => $toDate,
            'filling_type' => $validated['filling_type'] ?? null,
        ];

        $organizations = (new OrganizationRepository())->getAll();
        $invoicesForPayment = $this->repository->getAll($filters);

        $fillingTypes = self::FILLING_TYPES;

        return view(
            'documents.invoices-for-payment.index',
            compact(
                'invoicesForPayment',
                'organizations',
                'fillingTypes',
                'fromDate',
                'toDate'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreInvoiceForPaymentRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreInvoiceForPaymentRequest $request)
    {
        $validated = $request->validated();

        $invoiceForPayment = InvoiceForPayment::create(
            [
                'user_id' => Auth::user()->id,
                'organization_id' => (int)$validated['organization_id'],
                'organization_place_id' => (int)$validated['organization_place_id'],
                'organization_bank_id' => (int)$validated['organization_bank_id'],
                'contractor_id' => (int)$validated['contractor_id'],
                'contractor_place_id' => (int)$validated['contractor_place_id'],
                'contractor_bank_id' => (int)$validated['contractor_bank_id'],
                'number' => $validated['number'],
                'date' => $validated['date'],
                'director' => $validated['director'],
                'bookkeeper' => $validated['bookkeeper'],
                'filling_type' => $validated['filling_type'],
            ]
        );

        return redirect()
            ->route(
                'invoices_for_payment.edit',
                ['invoice_for_payment' => $invoiceForPayment->id]
            )
            ->with(
                'success',
                __(
                    'documents.invoices_for_payment.actions.create.success',
                    ['number' => $invoiceForPayment->number]
                )
            );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(Contractor $contractor)
    {
        $organizations = (new OrganizationRepository())->getForDocument();

        $fillingTypes = self::FILLING_TYPES;

        return view(
            'documents.invoices-for-payment.create',
            compact(
                'contractor',
                'organizations',
                'fillingTypes',
            )
        );
    }

    /**
     * Display the specified resource.
     *
     * @param InvoiceForPayment $invoiceForPayment
     *
     * @return View
     */
    public function show(InvoiceForPayment $invoiceForPayment)
    {
        $creator = new InvoiceForPaymentCreator($invoiceForPayment);

        $data = $creator->getData();

        return view(
            'documents.invoices-for-payment.show',
            compact('invoiceForPayment', 'data')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param InvoiceForPayment $invoiceForPayment
     *
     * @return View
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function edit(InvoiceForPayment $invoiceForPayment)
    {
        $fillingTypes = self::FILLING_TYPES;

        $invoiceForPayment = $this->repository->getById($invoiceForPayment->id);

        switch ($invoiceForPayment->filling_type) {
            case 'materials':
                $production = (new InvoiceForPaymentMaterialRepository())
                    ->getMaterials($invoiceForPayment->id);
                break;
            default:
                $production = (new InvoiceForPaymentProductRepository())
                    ->getProduction($invoiceForPayment->id);
                break;
        }

        return view(
            'documents.invoices-for-payment.edit',
            compact(
                'invoiceForPayment',
                'production',
                'fillingTypes'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateInvoiceForPaymentRequest $request
     * @param InvoiceForPayment              $invoiceForPayment
     *
     * @return RedirectResponse
     */
    public function update(UpdateInvoiceForPaymentRequest $request, InvoiceForPayment $invoiceForPayment)
    {
        $validated = $request->validated();

        $file = $validated['filename'] ?? null;

        $invoiceForPayment->fill(
            [
                'user_id' => Auth::user()->id,
                'organization_place_id' => (int)$validated['organization_place_id'],
                'organization_bank_id' => (int)$validated['organization_bank_id'],
                'contractor_place_id' => (int)$validated['contractor_place_id'],
                'contractor_bank_id' => (int)$validated['contractor_bank_id'],
                'number' => $validated['number'],
                'date' => $validated['date'],
                'director' => $validated['director'],
                'bookkeeper' => $validated['bookkeeper'],
                'filling_type' => $validated['filling_type'],
            ]
        );

        $invoiceForPayment->save();

        if ($file) {
            $fileStorage = $this->repository->getStorage($invoiceForPayment->id);
            $directory = $fileStorage->get('directory');
            $filename = $fileStorage->get('filename');
            File::attach($directory, $file, $filename);
            $invoiceForPayment->filename = $directory . $filename;
            $invoiceForPayment->save();
        }

        return back()
            ->with(
                'success',
                __(
                    'documents.invoices_for_payment.actions.update.success',
                    ['number' => $invoiceForPayment->number]
                )
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param InvoiceForPayment $invoiceForPayment
     *
     * @return RedirectResponse
     */
    public function destroy(InvoiceForPayment $invoiceForPayment)
    {
        $invoiceForPayment->delete();

        return back()
            ->with(
                'success',
                __(
                    'documents.invoices_for_payment.actions.delete.success',
                    ['number' => $invoiceForPayment->number]
                )
            );
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param InvoiceForPayment $invoiceForPayment
     *
     * @return RedirectResponse
     */
    public function restore(InvoiceForPayment $invoiceForPayment)
    {
        $invoiceForPayment->restore();

        return back()
            ->with(
                'success',
                __(
                    'documents.invoices_for_payment.actions.restore.success',
                    ['number' => $invoiceForPayment->number]
                )
            );
    }

    /**
     * @return void
     */
    protected function authorizeActions()
    {
        $this->authorizeResource(InvoiceForPayment::class, 'invoice_for_payment');
    }

    /**
     * @return string
     */
    protected function getRepository()
    {
        return InvoiceForPaymentRepository::class;
    }
}
