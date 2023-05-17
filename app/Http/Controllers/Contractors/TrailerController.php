<?php

namespace App\Http\Controllers\Contractors;

use App\Http\Controllers\CoreController;
use App\Http\Requests\Contractors\Trailers\StoreTrailerRequest;
use App\Http\Requests\Contractors\Trailers\UpdateTrailerRequest;
use App\Models\Contractors\Trailer;
use App\Repositories\Contractors\TrailerRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class TrailerController extends CoreController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTrailerRequest $request
     *
     * @return RedirectResponse
     */
    public function store(StoreTrailerRequest $request)
    {
        $validated = $request->validated()['trailer'];

        $trailer = Trailer::create(
            [
                'user_id' => Auth::user()->id,
                'contractor_id' => (int)$validated['contractor_id'],
                'type' => $validated['type'],
                'state_number' => $validated['state_number'],
            ]
        );

        return back()
            ->with(
                'success',
                __(
                    'contractors.trailers.actions.create.success',
                    ['number' => $trailer->state_number]
                )
            );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTrailerRequest $request
     * @param Trailer              $trailer
     *
     * @return RedirectResponse
     */
    public function update(UpdateTrailerRequest $request, Trailer $trailer)
    {
        $validated = $request->validated();

        foreach ($validated['trailers'] as $validatedTrailer) {
            Trailer::find((int)$validatedTrailer['id'])
                ->fill(
                    [
                        'user_id' => Auth::user()->id,
                        'type' => $validatedTrailer['type'],
                        'state_number' => $validatedTrailer['state_number'],
                    ]
                )
                ->save();
        }

        return back()
            ->with(
                'success',
                __('contractors.trailers.actions.update.success')
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Trailer $trailer
     *
     * @return RedirectResponse
     */
    public function destroy(Trailer $trailer)
    {
        $trailer->delete();

        return back()
            ->with(
                'success',
                __(
                    'contractors.trailers.actions.delete.success',
                    ['number' => $trailer->state_number]
                )
            );
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param Trailer $trailer
     *
     * @return RedirectResponse
     */
    public function restore(Trailer $trailer)
    {
        $trailer->restore();

        return back()
            ->with(
                'success',
                __(
                    'contractors.trailers.actions.restore.success',
                    ['number' => $trailer->state_number]
                )
            );
    }

    /**
     * @return void
     */
    protected function authorizeActions()
    {
        $this->authorizeResource(Trailer::class, 'trailer');
    }

    /**
     * @return string
     */
    protected function getRepository()
    {
        return TrailerRepository::class;
    }
}
