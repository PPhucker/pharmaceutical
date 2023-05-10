<?php

namespace App\Http\Controllers\Documents\Shipment\Protocols;

use App\Helpers\Date;
use App\Helpers\Documents\Shipment\ProtocolCreator;
use App\Helpers\File;
use App\Http\Controllers\CoreController;
use App\Http\Requests\Documents\Shipment\Protocols\CreateProtocolRequest;
use App\Http\Requests\Documents\Shipment\Protocols\IndexProtocolRequest;
use App\Http\Requests\Documents\Shipment\Protocols\StoreProtocolRequest;
use App\Http\Requests\Documents\Shipment\Protocols\UpdateProtocolRequest;
use App\Models\Documents\Shipment\Protocols\Protocol;
use App\Repositories\Admin\Organizations\OrganizationRepository;
use App\Repositories\Documents\Shipment\Protocols\ProtocolRepository;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProtocolController extends CoreController
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(IndexProtocolRequest $request)
    {
        $validated = $request->validated();

        $interval = Date::filter($request);

        $filters = [
            'organization_id' => $validated['organization_id'] ?? null,
            'from_date' => $interval->get('fromDate'),
            'to_date' => $interval->get('toDate'),
        ];

        $organizations = (new OrganizationRepository())->getAll();
        $protocols = $this->repository->getAll($filters);

        return view(
            'documents.shipment.protocols.index',
            compact(
                'protocols',
                'organizations',
                'filters'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProtocolRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreProtocolRequest $request)
    {
        $validated = $request->validated();

        $protocol = Protocol::create(
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
                    'documents.shipment.protocols.actions.create.success',
                    ['number' => $protocol->number]
                )
            );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(CreateProtocolRequest $request)
    {
        $validated = $request->validated();

        $packingListId = $validated['packing_list_id'];

        return view(
            'documents.shipment.protocols.create',
            compact('packingListId')
        );
    }

    /**
     * Display the specified resource.
     *
     * @param Protocol $protocol
     *
     * @return View
     */
    public function show(Protocol $protocol)
    {
        $creator = new ProtocolCreator($protocol->packingList);

        $data = $creator->getData();

        $date = Str::dateInWords(
            Carbon::create($protocol->date)->format('Y-m-d'),
            '-',
            ' '
        );

        $number = $protocol->number;

        return view(
            'documents.shipment.protocols.show',
            compact(
                'protocol',
                'date',
                'number',
                'data',
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Protocol $protocol
     *
     * @return View
     */
    public function edit(Protocol $protocol)
    {
        $protocol = $this->repository->getById($protocol->id);

        return view(
            'documents.shipment.protocols.edit',
            compact('protocol')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProtocolRequest $request
     * @param Protocol              $protocol
     *
     * @return RedirectResponse
     */
    public function update(UpdateProtocolRequest $request, Protocol $protocol)
    {
        $validated = $request->validated();

        $file = $validated['filename'] ?? null;

        $protocol->fill(
            [
                'updated_by_id' => Auth::user()->id,
                'number' => $validated['number'],
                'date' => $validated['date'],
            ]
        )
            ->save();

        if ($file) {
            $fileStorage = $this->repository->getStorage($protocol->id);
            $directory = $fileStorage->get('directory');
            $filename = $fileStorage->get('filename');
            File::attach($directory, $file, $filename);
            $protocol->filename = $directory . $filename;
            $protocol->save();
        }

        return back()
            ->with(
                'success',
                __(
                    'documents.shipment.protocols.actions.update.success',
                    ['number' => $protocol->number]
                )
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Protocol $protocol
     *
     * @return RedirectResponse
     */
    public function destroy(Protocol $protocol)
    {
        $protocol->delete();

        return back()
            ->with(
                'success',
                __(
                    'documents.shipment.protocols.actions.delete.success',
                    ['number' => $protocol->number]
                )
            );
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param Protocol $protocol
     *
     * @return RedirectResponse
     */
    public function restore(Protocol $protocol)
    {
        $protocol->restore();

        return back()
            ->with(
                'success',
                __(
                    'documents.shipment.protocols.actions.delete.success',
                    ['number' => $protocol->number]
                )
            );
    }

    /**
     * @return void
     */
    protected function authorizeActions()
    {
        $this->authorizeResource(Protocol::class, 'protocol');
    }

    /***
     * @return string
     */
    protected function getRepository()
    {
        return ProtocolRepository::class;
    }
}
