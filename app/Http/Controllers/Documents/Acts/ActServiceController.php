<?php

namespace App\Http\Controllers\Documents\Acts;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Documents\Acts\Data\StoreActServiceRequest;
use App\Http\Requests\Documents\Acts\Data\UpdateActServiceRequest;
use App\Models\Documents\Acts\ActService;
use App\Repositories\Documents\Acts\ActServiceRepository;
use Auth;
use Illuminate\Http\RedirectResponse;

class ActServiceController extends CoreController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreActServiceRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreActServiceRequest $request)
    {
        $validated = $request->validated()['act_service'];

        ActService::create(
            [
                'user_id' => Auth::user()->id,
                'act_id' => (int)$validated['act_id'],
                'service_id' => (int)$validated['service_id'],
                'quantity' => (int)$validated['quantity'],
                'price' => (float)$validated['price'],
                'nds' => (int)$validated['nds'] / 100,
            ]
        );

        return back()
            ->with(
                'success',
                __('documents.acts.data.actions.create.success')
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateActServiceRequest $request
     * @param ActService|null         $act_service
     *
     * @return RedirectResponse
     */
    public function update(UpdateActServiceRequest $request, ActService $act_service = null)
    {
        $validated = $request->validated();

        foreach ($validated['act_services'] as $validatedActService) {
            ActService::find((int)$validatedActService['id'])
                ->fill(
                    [
                        'user_id' => Auth::user()->id,
                        'quantity' => (int)$validatedActService['quantity'],
                        'price' => (float)$validatedActService['price'],
                        'nds' => (int)$validatedActService['nds'] / 100,
                    ]
                )
                ->save();
        }

        return back()
            ->with(
                'success',
                __('documents.acts.data.actions.update.success')
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ActService $actService
     *
     * @return RedirectResponse
     */
    public function destroy(ActService $actService)
    {
        $actService->delete();

        return back()
            ->with(
                'success',
                __('documents.acts.data.actions.delete.success')
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ActService $actService
     *
     * @return RedirectResponse
     */
    public function restore(ActService $actService)
    {
        $actService->restore();

        return back()
            ->with(
                'success',
                __('documents.acts.data.actions.restore.success')
            );
    }

    /**
     * @return void
     */
    protected function authorizeActions()
    {
        $this->authorizeResource(ActService::class, 'act_service');
    }

    /**
     * @return string
     */
    protected function getRepository()
    {
        return ActServiceRepository::class;
    }
}
