<?php

namespace App\Repositories\Admin\Organization\Transport;

use App\Models\Admin\Organization\Transport\Trailer;
use App\Repositories\Contractor\Transport\TrailerRepository as ContractorTrailerRepository;
use Auth;

/**
 * Репозиторий прицепа организации.
 */
class TrailerRepository extends ContractorTrailerRepository
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Trailer::class;
    }

    /**
     * @param array $validated
     *
     * @return Trailer
     */
    public function create(array $validated): Trailer
    {
        return $this->model->create(
            [
                'user_id' => Auth::user()->id,
                'organization_id' => (int)$validated['organization_id'],
                'type' => $validated['type'],
                'state_number' => $validated['state_number'],
            ]
        );
    }
}
