<?php

namespace App\Http\Controllers\Documents\Acts;

use App\Helpers\Date;
use App\Helpers\Documents\Acts\ActCreator;
use App\Helpers\File;
use App\Http\Controllers\CoreController;
use App\Http\Requests\Documents\Acts\IndexActRequest;
use App\Http\Requests\Documents\Acts\StoreActRequest;
use App\Http\Requests\Documents\Acts\UpdateActRequest;
use App\Models\Documents\Acts\Act;
use App\Repositories\Admin\Organization\OrganizationRepository;
use App\Repositories\Classifiers\Nomenclature\Services\ServiceRepository;
use App\Repositories\Documents\Acts\ActRepository;
use Auth;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Контроллер актов.
 */
class ActController extends CoreController
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexActRequest $request
     *
     * @return View
     */
    public function index(IndexActRequest $request): View
    {
        $validated = $request->validated();

        $date = Date::filter($request);

        $fromDate = $date->get('fromDate');
        $toDate = $date->get('toDate');

        $filters = [
            'organization_id' => $validated['organization_id'] ?? null,
            'fromDate' => $fromDate,
            'toDate' => $toDate
        ];

        $organizations = (new OrganizationRepository())->getAll();
        $acts = $this->repository->getAll($filters);

        return view(
            'documents.acts.index',
            compact(
                'acts',
                'organizations',
                'fromDate',
                'toDate'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreActRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreActRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $act = Act::create(
            [
                'user_id' => Auth::user()->id,
                'organization_id' => (int)$validated['organization_id'],
                'contractor_id' => (int)$validated['contractor_id'],
                'number' => $validated['number'],
                'date' => $validated['date'],
            ]
        );

        return redirect()
            ->route(
                'acts.edit',
                ['act' => $act->id]
            )
            ->with(
                'success',
                __(
                    'documents.acts.actions.create.success',
                    ['number' => $act->number]
                )
            );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $organizations = (new OrganizationRepository())->getAll(false);

        $currentDate = Carbon::now()->format('Y-m-d');

        return view(
            'documents.acts.create',
            compact(
                'organizations',
                'currentDate',
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Act $act
     *
     * @return View
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function edit(Act $act): View
    {
        $data = (new ActCreator($act))->getData();

        $act = $this->repository->getById($act->id);

        $services = (new ServiceRepository())->getAll(false);

        $title = __('documents.acts.act')
            . ' №'
            . $act->number
            . ' '
            . $act->date;

        return view(
            'documents.acts.edit',
            compact(
                'act',
                'services',
                'data',
                'title',
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateActRequest $request
     * @param Act              $act
     *
     * @return RedirectResponse
     */
    public function update(UpdateActRequest $request, Act $act): RedirectResponse
    {
        $validated = $request->validated();

        $file = $validated['filename'] ?? null;

        $act->fill(
            [
                'user_id' => Auth::user()->id,
                'number' => $validated['number'],
                'date' => $validated['date'],
            ]
        )
            ->save();

        if ($file) {
            $fileStorage = $this->repository->getStorage($act->id);
            $directory = $fileStorage->get('directory');
            $filename = $fileStorage->get('filename');
            File::attach($directory, $file, $filename);
            $act->filename = $directory . $filename;
            $act->save();
        }


        return back()
            ->with(
                'success',
                __(
                    'documents.acts.actions.update.success',
                    ['number' => $act->number]
                )
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Act $act
     *
     * @return RedirectResponse
     */
    public function destroy(Act $act): RedirectResponse
    {
        $act->delete();

        return back()
            ->with(
                'success',
                __(
                    'documents.acts.actions.delete.success',
                    ['number' => $act->number]
                )
            );
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param Act $act
     *
     * @return RedirectResponse
     */
    public function restore(Act $act): RedirectResponse
    {
        $act->restore();

        return back()
            ->with(
                'success',
                __(
                    'documents.acts.actions.restore.success',
                    ['number' => $act->number]
                )
            );
    }

    /**
     * @inheritDoc
     */
    protected function authorizeActions(): void
    {
        $this->authorizeResource(Act::class, 'act');
    }

    /**
     * @inheritDoc
     */
    protected function getRepository(): string
    {
        return ActRepository::class;
    }
}
