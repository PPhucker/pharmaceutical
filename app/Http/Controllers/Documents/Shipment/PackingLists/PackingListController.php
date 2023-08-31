<?php

namespace App\Http\Controllers\Documents\Shipment\PackingLists;

use App\Helpers\Date;
use App\Helpers\Documents\Shipment\PackingListCreator;
use App\Helpers\File;
use App\Http\Controllers\CoreController;
use App\Http\Requests\Documents\Shipment\PackingLists\ApprovalPackingListRequest;
use App\Http\Requests\Documents\Shipment\PackingLists\ApprovePackingListRequest;
use App\Http\Requests\Documents\Shipment\PackingLists\CreatePackingListRequest;
use App\Http\Requests\Documents\Shipment\PackingLists\IndexPackingListRequest;
use App\Http\Requests\Documents\Shipment\PackingLists\RedirectPackingListRequest;
use App\Http\Requests\Documents\Shipment\PackingLists\StorePackingListRequest;
use App\Http\Requests\Documents\Shipment\PackingLists\UpdatePackingListRequest;
use App\Models\Documents\InvoicesForPayment\InvoiceForPayment;
use App\Models\Documents\Shipment\PackingLists\PackingList;
use App\Models\Documents\Shipment\PackingLists\PackingListProduct;
use App\Notifications\Shipment\ToDigitalCommunication;
use App\Notifications\Shipment\ToMarketing;
use App\Repositories\Admin\Organizations\OrganizationRepository;
use App\Repositories\Admin\UserRepository;
use App\Repositories\Contractors\ContractorRepository;
use App\Repositories\Documents\InvoicesForPayment\InvoiceForPaymentProductRepository;
use App\Repositories\Documents\InvoicesForPayment\InvoiceForPaymentRepository;
use App\Repositories\Documents\Shipment\PackingLists\PackingListProductRepository;
use App\Repositories\Documents\Shipment\PackingLists\PackingListRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Контроллер товарной накладной
 */
class PackingListController extends CoreController
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexPackingListRequest $request
     *
     * @return View
     */
    public function index(IndexPackingListRequest $request): View
    {
        $validated = $request->validated();

        $date = Date::filter($request);

        $fromDate = $date->get('fromDate');
        $toDate = $date->get('toDate');

        $filters = [
            'organization_id' => $validated['organization_id'] ?? null,
            'from_date' => $fromDate,
            'to_date' => $toDate,
        ];

        $organizations = (new OrganizationRepository())->getAll();

        $packingLists = $this->repository->getAll($filters);

        $choice = $validated['choice'] ?? null;

        return view(
            'documents.shipment.packing-lists.index',
            compact(
                'packingLists',
                'organizations',
                'fromDate',
                'toDate',
                'choice',
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePackingListRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StorePackingListRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $packingList = PackingList::create(
            [
                'created_by_id' => Auth::user()->id,
                'updated_by_id' => Auth::user()->id,
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
                'storekeeper' => $validated['storekeeper'],
            ]
        );

        foreach ($validated['invoice_for_payment_product'] as $product) {
            PackingListProduct::create(
                [
                    'user_id' => Auth::user()->id,
                    'invoice_for_payment_id' => (int)$product['invoice_for_payment_id'],
                    'packing_list_id' => (int)$packingList->id,
                    'product_id' => (int)$product['product_catalog_id'],
                    'series' => $product['series'],
                    'price' => (float)$product['price'],
                    'quantity' => (int)$product['quantity'],
                    'nds' => (int)$product['nds'] / 100,
                ]
            );
        }

        return redirect()
            ->route(
                'packing_lists.edit',
                ['packing_list' => $packingList->id]
            )
            ->with(
                'success',
                __(
                    'documents.shipment.packing_lists.actions.create.success',
                    ['number' => $packingList->number]
                )
            );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreatePackingListRequest $request
     *
     * @return View
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function create(CreatePackingListRequest $request): View
    {
        $validated = $request->validated()['invoice_for_payment_id'];

        $organization = null;
        $contractor = null;
        $production = [];

        foreach ($validated as $invoiceForPaymentId) {
            $invoiceForPayment = InvoiceForPayment::find($invoiceForPaymentId);
            $production[] = (new InvoiceForPaymentProductRepository())
                ->getInvoiceForPaymentProduction($invoiceForPaymentId);
            if (!$organization) {
                $organization = (new OrganizationRepository())
                    ->getById($invoiceForPayment->organization->id);
                $contractor = (new ContractorRepository())
                    ->getById($invoiceForPayment->contractor->id);
            }
        }

        $series = (new PackingListProductRepository())->getSeriesNumbers();

        $currentDate = Carbon::now()->format('Y-m-d');

        return view(
            'documents.shipment.packing-lists.create',
            compact(
                'organization',
                'contractor',
                'production',
                'series',
                'currentDate',
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PackingList $packingList
     *
     * @return View
     */
    public function edit(PackingList $packingList): View
    {
        /**
         * Данные для формирования печати.
         */
        $data = (new PackingListCreator($packingList))->getData();

        $packingList = $this->repository->getById($packingList->id);

        $invoicesForPaymentProduction = [];
        $invoicesForPaymentId = [];

        foreach ($packingList->production as $product) {
            $invoicesForPaymentId[] = $product->invoice_for_payment_id;
        }

        foreach (array_unique($invoicesForPaymentId) as $invoiceForPaymentId) {
            $invoiceForPayment = (new InvoiceForPaymentRepository())->getById($invoiceForPaymentId);
            $invoicesForPaymentProduction[] = $invoiceForPayment->production;
        }

        $title = __('documents.shipment.packing_lists.packing_list')
            . ' №'
            . $packingList->number
            . ' '
            . $packingList->date;

        return view(
            'documents.shipment.packing-lists.edit',
            compact(
                'packingList',
                'invoicesForPaymentProduction',
                'title',
                'data',
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePackingListRequest $request
     * @param PackingList              $packingList
     *
     * @return RedirectResponse
     */
    public function update(UpdatePackingListRequest $request, PackingList $packingList)
    {
        $validated = $request->validated();

        $file = $validated['filename'] ?? null;

        $packingList->fill(
            [
                'updated_by_id' => Auth::user()->id,
                'number' => $validated['number'],
                'date' => $validated['date'],
                'organization_place_id' => (int)$validated['organization_place_id'],
                'organization_bank_id' => (int)$validated['organization_bank_id'],
                'contractor_place_id' => (int)$validated['contractor_place_id'],
                'contractor_bank_id' => (int)$validated['contractor_bank_id'],
                'director' => $validated['director'],
                'bookkeeper' => $validated['bookkeeper'],
                'storekeeper' => $validated['storekeeper'],
            ]
        );

        $packingList->save();

        if ($file) {
            $fileStorage = $this->repository->getStorage($packingList->id);
            $directory = $fileStorage->get('directory');
            $filename = $fileStorage->get('filename');
            File::attach($directory, $file, $filename);
            $packingList->filename = $directory . $filename;
            $packingList->save();
        }

        return back()
            ->with(
                'success',
                __(
                    'documents.shipment.packing_lists.actions.update.success',
                    ['number' => $packingList->number]
                )
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PackingList $packingList
     *
     * @return RedirectResponse
     */
    public function destroy(PackingList $packingList)
    {
        $packingList->delete();

        return back()
            ->with(
                'success',
                __(
                    'documents.shipment.packing_lists.actions.delete.success',
                    ['number' => $packingList->number]
                )
            );
    }


    /**
     * Restore the specified resource from storage.
     *
     * @param PackingList $packingList
     *
     * @return RedirectResponse
     */
    public function restore(PackingList $packingList)
    {
        $packingList->restore();

        return back()
            ->with(
                'success',
                __(
                    'documents.shipment.packing_lists.actions.restore.success',
                    ['number' => $packingList->number]
                )
            );
    }

    /**
     * @param RedirectPackingListRequest $request
     *
     * @return RedirectResponse
     */
    public function redirect(RedirectPackingListRequest $request)
    {
        $validated = $request->validated();

        $document = $validated['document'];

        return redirect()
            ->route($document . '.create', [
                'packing_list_id' => $validated['packing_list_id']
            ]);
    }


    /**
     * @param ApprovalPackingListRequest $request
     *
     * @return View
     */
    public function approval(ApprovalPackingListRequest $request)
    {
        $validated = $request->validated();

        $date = Date::filter($request, 'day');

        $fromDate = $date->get('fromDate');
        $toDate = $date->get('toDate');

        $filters = [
            'organization_id' => $validated['organization_id'] ?? null,
            'from_date' => $fromDate,
            'to_date' => $toDate,
        ];

        $organizations = (new OrganizationRepository())->getAll();
        $packingLists = $this->repository->getApproval($filters);

        return view(
            'documents.shipment.packing-lists.approval',
            compact(
                'packingLists',
                'organizations',
                'fromDate',
                'toDate',
            )
        );
    }

    /**
     * @param ApprovePackingListRequest $request
     * @param PackingList               $packingList
     *
     * @return RedirectResponse
     */
    public function approve(ApprovePackingListRequest $request, PackingList $packingList)
    {
        $validated = $request->validated();

        $file = $validated['filename'] ?? null;

        $packingList->timestamps = false;

        $packingList->fill(
            [
                'approved_by_id' => Auth::user()->id,
                'approved' => (int)$validated['approved'],
                'comment' => $validated['comment'],
                'approved_at' => null,
            ]
        );

        if ((int)$validated['approved'] === 1) {
            $packingList->fill(
                [
                    'approved_at' => Carbon::now(),
                    'approved' => 1,
                    'comment' => null,
                ]
            );
        }

        $packingList->save();

        if ($file) {
            $fileStorage = $this->repository->getStorage($packingList->id);
            $directory = $fileStorage->get('directory');
            $filename = $fileStorage->get('filename');
            File::attach($directory, $file, $filename);
            $packingList->filename = $directory . $filename;
            $packingList->save();
        }

        return back()
            ->with(
                'success',
                __(
                    'documents.shipment.packing_lists.actions.update.success',
                    ['number' => $packingList->number]
                )
            );
    }

    /**
     * @param PackingList $packingList
     *
     * @return RedirectResponse
     */
    public function sendEmailApprovalToMarketing(PackingList $packingList)
    {
        $to = (new UserRepository())->getMarketingUsers();

        Notification::route('mail', $to)
            ->notify(
                (new ToMarketing($packingList))
            );

        return back()
            ->with(
                'success',
                __('documents.shipment.approval.e-mail.send.success')
            );
    }

    /**
     * @param PackingList $packingList
     *
     * @return RedirectResponse
     */
    public function sendEmailApprovalToDigitalCommunication(PackingList $packingList)
    {
        $to = (new UserRepository())->getForCreatedShipmentNotification();

        Notification::route('mail', $to)
            ->notify(
                (new ToDigitalCommunication($packingList))
            );

        return back()
            ->with(
                'success',
                __('documents.shipment.approval.e-mail.send.success')
            );
    }

    /**
     * @return void
     */
    protected function authorizeActions()
    {
        $this->authorizeResource(PackingList::class, 'packing_list');
    }

    protected function getRepository()
    {
        return PackingListRepository::class;
    }
}
