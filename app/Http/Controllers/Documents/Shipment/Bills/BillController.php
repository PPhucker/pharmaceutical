<?php

namespace App\Http\Controllers\Documents\Shipment\Bills;

use App\Helpers\Date;
use App\Helpers\Documents\Shipment\BillCreator;
use App\Helpers\File;
use App\Http\Controllers\CoreController;
use App\Http\Requests\Documents\Shipment\Bills\CreateBillRequest;
use App\Http\Requests\Documents\Shipment\Bills\IndexBillRequest;
use App\Http\Requests\Documents\Shipment\Bills\StoreBillRequest;
use App\Http\Requests\Documents\Shipment\Bills\UpdateBillRequest;
use App\Models\Documents\Shipment\Bills\Bill;
use App\Repositories\Admin\Organizations\OrganizationRepository;
use App\Repositories\Documents\Shipment\Bills\BillRepository;
use Auth;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class BillController extends CoreController
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(IndexBillRequest $request)
    {
        $validated = $request->validated();

        $interval = Date::filter($request);

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
    public function store(StoreBillRequest $request)
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
            ->route('packing_lists.index')
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
     * @return View
     */
    public function create(CreateBillRequest $request)
    {
        $validated = $request->validated();

        $packingListId = $validated['packing_list_id'];

        return view(
            'documents.shipment.bills.create',
            compact('packingListId')
        );
    }

    /**
     * Display the specified resource.
     *
     * @param Bill $bill
     *
     * @return View
     */
    public function show(Bill $bill)
    {
        $creator = new BillCreator($bill->packingList);

        $data = $creator->getData();

        $date = Str::dateInWords(
            Carbon::create($bill->date)->format('Y-m-d'),
            '-',
            ' '
        );

        $number = $bill->number;

        return view(
            'documents.shipment.bills.show',
            compact(
                'date',
                'number',
                'data'
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Bill $bill
     *
     * @return View
     */
    public function edit(Bill $bill)
    {
        $bill = $this->repository->getById($bill->id);

        return view(
            'documents.shipment.bills.edit',
            compact('bill')
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
    public function update(UpdateBillRequest $request, Bill $bill)
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
    public function destroy(Bill $bill)
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
    public function restore(Bill $bill)
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
     * @return void
     */
    protected function authorizeActions()
    {
        $this->authorizeResource(Bill::class, 'bill');
    }

    /**
     * @return string
     */
    protected function getRepository()
    {
        return BillRepository::class;
    }
}
