<?php

namespace App\Http\Controllers\Documents\Shipment\Appendixes;

use App\Helpers\Date;
use App\Helpers\Documents\Shipment\AppendixCreator;
use App\Helpers\File;
use App\Http\Controllers\CoreController;
use App\Http\Requests\Documents\Shipment\Appendixes\ApproveAppendixRequest;
use App\Http\Requests\Documents\Shipment\Appendixes\CreateAppendixRequest;
use App\Http\Requests\Documents\Shipment\Appendixes\IndexAppendixRequest;
use App\Http\Requests\Documents\Shipment\Appendixes\StoreAppendixRequest;
use App\Http\Requests\Documents\Shipment\Appendixes\UpdateAppendixRequest;
use App\Models\Documents\Shipment\Appendixes\Appendix;
use App\Models\Documents\Shipment\PackingLists\PackingList;
use App\Repositories\Admin\Organization\OrganizationRepository;
use App\Repositories\Documents\Shipment\Appendixes\AppendixRepository;
use Auth;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

/**
 * Контроллер приложения.
 */
class AppendixController extends CoreController
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexAppendixRequest $request
     *
     * @return View
     */
    public function index(IndexAppendixRequest $request): View
    {
        $validated = $request->validated();

        $interval = Date::filter($request);

        $filters = [
            'organization_id' => $validated['organization_id'] ?? null,
            'from_date' => $interval->get('fromDate'),
            'to_date' => $interval->get('toDate'),
        ];

        $organizations = (new OrganizationRepository())->getAll();
        $appendixes = $this->repository->getAll($filters);

        return view(
            'documents.shipment.appendixes.index',
            compact(
                'appendixes',
                'organizations',
                'filters'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAppendixRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreAppendixRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $appendix = Appendix::create(
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
                    'documents.shipment.appendixes.actions.create.success',
                    ['number' => $appendix->number]
                )
            );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateAppendixRequest $request
     *
     * @return View
     */
    public function create(CreateAppendixRequest $request): View
    {
        $validated = $request->validated();

        $packingList = PackingList::find((int)$validated['packing_list_id']);

        return view(
            'documents.shipment.appendixes.create',
            compact('packingList')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Appendix $appendix
     *
     * @return View
     */
    public function edit(Appendix $appendix): View
    {
        $appendix = $this->repository->getById($appendix->id);

        $data = (new AppendixCreator($appendix->packingList))->getData();

        $date = Str::dateInWords(
            Carbon::create($appendix->date)->format('Y-m-d'),
            '-',
            ' '
        );

        $number = $appendix->number;

        $title = __('documents.shipment.appendixes.appendix')
            . ' №'
            . $appendix->number
            . ' '
            . $appendix->date;

        return view(
            'documents.shipment.appendixes.edit',
            compact(
                'appendix',
                'data',
                'number',
                'title',
                'date',
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAppendixRequest $request
     * @param Appendix              $appendix
     *
     * @return RedirectResponse
     */
    public function update(UpdateAppendixRequest $request, Appendix $appendix): RedirectResponse
    {
        $validated = $request->validated();

        $file = $validated['filename'] ?? null;

        $appendix->fill(
            [
                'updated_by_id' => Auth::user()->id,
                'number' => $validated['number'],
                'date' => $validated['date'],
            ]
        )
            ->save();

        if ($file) {
            $fileStorage = $this->repository->getStorage($appendix->id);
            $directory = $fileStorage->get('directory');
            $filename = $fileStorage->get('filename');
            File::attach($directory, $file, $filename);
            $appendix->filename = $directory . $filename;
            $appendix->save();
        }

        return back()
            ->with(
                'success',
                __(
                    'documents.shipment.appendixes.actions.update.success',
                    ['number' => $appendix->number]
                )
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Appendix $appendix
     *
     * @return RedirectResponse
     */
    public function destroy(Appendix $appendix): RedirectResponse
    {
        $appendix->delete();

        return back()
            ->with(
                'success',
                __(
                    'documents.shipment.appendixes.actions.delete.success',
                    ['number' => $appendix->number]
                )
            );
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param Appendix $appendix
     *
     * @return RedirectResponse
     */
    public function restore(Appendix $appendix): RedirectResponse
    {
        $appendix->restore();

        return back()
            ->with(
                'success',
                __(
                    'documents.shipment.appendixes.actions.delete.success',
                    ['number' => $appendix->number]
                )
            );
    }

    /**
     * @param ApproveAppendixRequest $request
     * @param Appendix               $appendix
     *
     * @return RedirectResponse
     */
    public function approve(ApproveAppendixRequest $request, Appendix $appendix): RedirectResponse
    {
        $validated = $request->validated();

        $file = $validated['filename'] ?? null;

        $appendix->timestamps = false;

        $appendix->fill(
            [
                'approved_by_id' => Auth::user()->id,
                'approved' => (int)$validated['approved'],
                'comment' => $validated['comment'],
                'approved_at' => null,
            ]
        );

        if ((int)$validated['approved'] === 1) {
            $appendix->fill(
                [
                    'approved_at' => Carbon::now(),
                    'approved' => 1,
                    'comment' => null,
                ]
            );
        }

        $appendix->save();

        if ($file) {
            $fileStorage = $this->repository->getStorage($appendix->id);
            $directory = $fileStorage->get('directory');
            $filename = $fileStorage->get('filename');
            File::attach($directory, $file, $filename);
            $appendix->filename = $directory . $filename;
            $appendix->save();
        }

        return back()
            ->with(
                'success',
                __(
                    'documents.shipment.appendixes.actions.update.success',
                    ['number' => $appendix->number]
                )
            );
    }

    /**
     * @return void
     */
    protected function authorizeActions(): void
    {
        $this->authorizeResource(Appendix::class, 'appendix');
    }

    /**
     * @return string
     */
    protected function getRepository(): string
    {
        return AppendixRepository::class;
    }
}
