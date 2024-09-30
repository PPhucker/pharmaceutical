<?php

namespace App\Http\Controllers\Documents\Shipment\Bills;

use App\Helpers\DateHelper;
use App\Helpers\Documents\Shipment\BillCreator;
use App\Helpers\File;
use App\Http\Controllers\CoreController;
use App\Http\Requests\Documents\Shipment\Bills\ApproveBillRequest;
use App\Http\Requests\Documents\Shipment\Bills\CreateBillRequest;
use App\Http\Requests\Documents\Shipment\Bills\IndexBillRequest;
use App\Http\Requests\Documents\Shipment\Bills\StoreBillRequest;
use App\Http\Requests\Documents\Shipment\Bills\UpdateBillRequest;
use App\Models\Documents\Shipment\Bills\Bill;
use App\Models\Documents\Shipment\PackingLists\PackingList;
use App\Repositories\Admin\Organization\OrganizationRepository;
use App\Repositories\Documents\Shipment\Bills\BillRepository;
use Auth;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

/**
 * Контроллер счет-фактуры.
 */
class BillController extends CoreController
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexBillRequest $request
     *
     * @return View
     */
    public function index(IndexBillRequest $request): View
    {
        $validated = $request->validated();

        $interval = DateHelper::filter($request);

        $filters = [
            'organization_id' => $validated['organization_id'] ?? null,
            'from_date' => $interval->get('fromDate'),
            'to_date' => $interval->get('toDate'),
        ];

        $organizations = (new OrganizationRepository())->getAll();
        $bills = $this->repository->getAll($filters);

        return view(
            'documents.shipment.bills.index',
            compact(
                'bills',
                'organizations',
                'filters'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBillRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreBillRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $bill = Bill::create(
            [
                'created_by_id' => Auth::user()->id,
                'updated_by_id' => Auth::user()->id,
                'packing_list_id' => (int)$validated['packing_list_id'],
                'number' => $validated['number'],
                'date' => $validated['date'],
            ]
        );

        return redirect()
            ->route('packing_lists.index', ['choice' => (int)$validated['packing_list_id']])
            ->with(
                'success',
                __(
                    'documents.shipment.bills.actions.create.success',
                    ['number' => $bill->number]
                )
            );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateBillRequest $request
     *
     * @return View
     */
    public function create(CreateBillRequest $request): View
    {
        $validated = $request->validated();

        $packingList = PackingList::find((int)$validated['packing_list_id']);

        return view(
            'documents.shipment.bills.create',
            compact('packingList')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Bill $bill
     *
     * @return View
     */
    public function edit(Bill $bill): View
    {
        $bill = $this->repository->getById($bill->id);

        $data = (new BillCreator($bill->packingList))->getData();

        $date = Str::dateInWords(
            Carbon::create($bill->date)->format('Y-m-d'),
            '-',
            ' '
        );

        $number = $bill->number;

        $title = __('documents.shipment.bills.bill')
            . ' №'
            . $bill->number
            . ' '
            . $bill->date;

        return view(
            'documents.shipment.bills.edit',
            compact(
                'bill',
                'data',
                'date',
                'number',
                'title',
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBillRequest $request
     * @param Bill              $bill
     *
     * @return RedirectResponse
     */
    public function update(UpdateBillRequest $request, Bill $bill): RedirectResponse
    {
        $validated = $request->validated();

        $file = $validated['filename'] ?? null;

        $bill->fill(
            [
                'updated_by_id' => Auth::user()->id,
                'number' => $validated['number'],
                'date' => $validated['date'],
            ]
        )
            ->save();

        if ($file) {
            $fileStorage = $this->repository->getStorage($bill->id);
            $directory = $fileStorage->get('directory');
            $filename = $fileStorage->get('filename');
            File::attach($directory, $file, $filename);
            $bill->filename = $directory . $filename;
            $bill->save();
        }

        return back()
            ->with(
                'success',
                __(
                    'documents.shipment.bills.actions.update.success',
                    ['number' => $bill->number]
                )
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Bill $bill
     *
     * @return RedirectResponse
     */
    public function destroy(Bill $bill): RedirectResponse
    {
        $bill->delete();

        return back()
            ->with(
                'success',
                __(
                    'documents.shipment.bills.actions.delete.success',
                    ['number' => $bill->number]
                )
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Bill $bill
     *
     * @return RedirectResponse
     */
    public function restore(Bill $bill): RedirectResponse
    {
        $bill->restore();

        return back()
            ->with(
                'success',
                __(
                    'documents.shipment.bills.actions.restore.success',
                    ['number' => $bill->number]
                )
            );
    }

    /**
     * @param ApproveBillRequest $request
     * @param Bill               $bill
     *
     * @return RedirectResponse
     */
    public function approve(ApproveBillRequest $request, Bill $bill): RedirectResponse
    {
        $validated = $request->validated();

        $file = $validated['filename'] ?? null;

        $bill->timestamps = false;

        $bill->fill(
            [
                'approved_by_id' => Auth::user()->id,
                'approved' => (int)$validated['approved'],
                'comment' => $validated['comment'],
                'approved_at' => null,
            ]
        );

        if ((int)$validated['approved'] === 1) {
            $bill->fill(
                [
                    'approved_at' => \Illuminate\Support\Carbon::now(),
                    'approved' => 1,
                    'comment' => null,
                ]
            );
        }

        $bill->save();

        if ($file) {
            $fileStorage = $this->repository->getStorage($bill->id);
            $directory = $fileStorage->get('directory');
            $filename = $fileStorage->get('filename');
            File::attach($directory, $file, $filename);
            $bill->filename = $directory . $filename;
            $bill->save();
        }

        return back()
            ->with(
                'success',
                __(
                    'documents.shipment.bills.actions.update.success',
                    ['number' => $bill->number]
                )
            );
    }

    /**
     * @return void
     */
    protected function authorizeActions(): void
    {
        $this->authorizeResource(Bill::class, 'bill');
    }

    /**
     * @return string
     */
    protected function getRepository(): string
    {
        return BillRepository::class;
    }
}
