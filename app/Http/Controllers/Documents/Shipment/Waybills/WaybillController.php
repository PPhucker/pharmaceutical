<?php

namespace App\Http\Controllers\Documents\Shipment\Waybills;

use App\Helpers\DateHelper;
use App\Helpers\Documents\Shipment\WaybillCreator;
use App\Helpers\File;
use App\Http\Controllers\CoreController;
use App\Http\Requests\Documents\Shipment\Waybills\ApproveWaybillRequest;
use App\Http\Requests\Documents\Shipment\Waybills\CreateWaybillRequest;
use App\Http\Requests\Documents\Shipment\Waybills\IndexWaybillRequest;
use App\Http\Requests\Documents\Shipment\Waybills\StoreWaybillRequest;
use App\Http\Requests\Documents\Shipment\Waybills\UpdateWaybillRequest;
use App\Models\Documents\Shipment\Waybills\Waybill;
use App\Repositories\Admin\Organization\OrganizationRepository;
use App\Repositories\Documents\Shipment\PackingLists\PackingListRepository;
use App\Repositories\Documents\Shipment\Waybills\WaybillRepository;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Контроллер товарно-транспортной накладной.
 */
class WaybillController extends CoreController
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexWaybillRequest $request
     *
     * @return View
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function index(IndexWaybillRequest $request): View
    {
        $validated = $request->validated();

        $interval = DateHelper::filter($request);

        $filters = [
            'organization_id' => $validated['organization_id'] ?? null,
            'from_date' => $interval->get('fromDate'),
            'to_date' => $interval->get('toDate'),
        ];

        $organizations = (new OrganizationRepository())->getAll();
        $waybills = (new WaybillRepository())->getAll($filters);

        return view(
            'documents.shipment.waybills.index',
            compact(
                'waybills',
                'organizations',
                'filters'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreWaybillRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreWaybillRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $waybill = Waybill::create(
            [
                'created_by_id' => Auth::user()->id,
                'updated_by_id' => Auth::user()->id,
                'packing_list_id' => (int)$validated['packing_list_id'],
                'number' => $validated['number'],
                'date' => $validated['date'],
                'car_model' => $validated['car_model'],
                'state_car_number' => $validated['state_car_number'],
                'driver' => $validated['driver'],
                'licence_card' => $validated['licence_card'],
                'type_of_transportation' => $validated['type_of_transportation'],
                'trailer_1' => $validated['trailer_1'],
                'trailer_2' => $validated['trailer_2'],
                'state_trailer_1_number' => $validated['state_trailer_1_number'],
                'state_trailer_2_number' => $validated['state_trailer_2_number'],
            ]
        );

        return redirect()
            ->route('packing_lists.index', ['choice' => (int)$validated['packing_list_id']])
            ->with(
                'success',
                __(
                    'documents.shipment.waybills.actions.create.success',
                    ['number' => $waybill->number]
                )
            );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateWaybillRequest $request
     *
     * @return View
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function create(CreateWaybillRequest $request): View
    {
        $validated = $request->validated();

        $packingList = (new PackingListRepository())
            ->getById((int)$validated['packing_list_id']);

        return view(
            'documents.shipment.waybills.create',
            compact('packingList')
        );
    }

    /**
     * Display the specified resource.
     *
     * @param Waybill $waybill
     *
     * @return View
     */
    public function show(Waybill $waybill): View
    {
        return view(
            'documents.shipment.waybills.show',
            compact(
                'waybill',
                'date',
                'number',
                'billNumber',
                'data',
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Waybill $waybill
     *
     * @return View
     */
    public function edit(Waybill $waybill): View
    {
        $waybill = $this->repository->getById($waybill->id);

        $packingList = $waybill->packingList;

        $data = (new WaybillCreator($packingList))->getData();

        $date = $waybill->date;

        $billNumber = $packingList->bill->number;

        $number = $waybill->number;

        return view(
            'documents.shipment.waybills.edit',
            compact(
                'waybill',
                'data',
                'date',
                'billNumber',
                'number',
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateWaybillRequest $request
     * @param Waybill              $waybill
     *
     * @return RedirectResponse
     */
    public function update(UpdateWaybillRequest $request, Waybill $waybill): RedirectResponse
    {
        $validated = $request->validated();

        $file = $validated['filename'] ?? null;

        $waybill->fill(
            [
                'updated_by_id' => Auth::user()->id,
                'number' => $validated['number'],
                'date' => $validated['date'],
                'car_model' => $validated['car_model'],
                'state_car_number' => $validated['state_car_number'],
                'driver' => $validated['driver'],
                'licence_card' => $validated['licence_card'],
                'type_of_transportation' => $validated['type_of_transportation'],
                'trailer_1' => $validated['trailer_1'],
                'trailer_2' => $validated['trailer_2'],
                'state_trailer_1_number' => $validated['state_trailer_1_number'],
                'state_trailer_2_number' => $validated['state_trailer_2_number'],
            ]
        )
            ->save();

        if ($file) {
            $fileStorage = $this->repository->getStorage($waybill->id);
            $directory = $fileStorage->get('directory');
            $filename = $fileStorage->get('filename');
            File::attach($directory, $file, $filename);
            $waybill->filename = $directory . $filename;
            $waybill->save();
        }

        return back()
            ->with(
                'success',
                __(
                    'documents.shipment.waybills.actions.update.success',
                    ['number' => $waybill->number]
                )
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Waybill $waybill
     *
     * @return RedirectResponse
     */
    public function destroy(Waybill $waybill): RedirectResponse
    {
        $waybill->delete();

        return back()
            ->with(
                'success',
                __(
                    'documents.shipment.waybills.actions.delete.success',
                    ['number' => $waybill->number]
                )
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Waybill $waybill
     *
     * @return RedirectResponse
     */
    public function restore(Waybill $waybill): RedirectResponse
    {
        $waybill->restore();

        return back()
            ->with(
                'success',
                __(
                    'documents.shipment.waybills.actions.restore.success',
                    ['number' => $waybill->number]
                )
            );
    }

    /**
     * @param ApproveWaybillRequest $request
     * @param Waybill               $waybill
     *
     * @return RedirectResponse
     */
    public function approve(ApproveWaybillRequest $request, Waybill $waybill): RedirectResponse
    {
        $validated = $request->validated();

        $file = $validated['filename'] ?? null;

        $waybill->timestamps = false;

        $waybill->fill(
            [
                'approved_by_id' => Auth::user()->id,
                'approved' => (int)$validated['approved'],
                'comment' => $validated['comment'],
                'approved_at' => null,
            ]
        );

        if ((int)$validated['approved'] === 1) {
            $waybill->fill(
                [
                    'approved_at' => Carbon::now(),
                    'approved' => 1,
                    'comment' => null,
                ]
            );
        }

        $waybill->save();

        if ($file) {
            $fileStorage = $this->repository->getStorage($waybill->id);
            $directory = $fileStorage->get('directory');
            $filename = $fileStorage->get('filename');
            File::attach($directory, $file, $filename);
            $waybill->filename = $directory . $filename;
            $waybill->save();
        }

        return back()
            ->with(
                'success',
                __(
                    'documents.shipment.waybills.actions.update.success',
                    ['number' => $waybill->number]
                )
            );
    }

    /**
     * @return void
     */
    protected function authorizeActions(): void
    {
        $this->authorizeResource(Waybill::class, 'waybill');
    }

    /**
     * @return string
     */
    protected function getRepository(): string
    {
        return WaybillRepository::class;
    }
}
