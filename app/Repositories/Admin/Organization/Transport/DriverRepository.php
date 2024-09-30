<?php

namespace App\Repositories\Admin\Organization\Transport;

use App\Models\Admin\Organization\Transport\Driver;
use App\Repositories\Contractor\Transport\DriverRepository as ContractorDriverRepository;
use Auth;

/**
 * Реоизторий водителя орагнизации.
 */
class DriverRepository extends ContractorDriverRepository
{
    /**
     * @param array $validated
     *
     * @return Driver
     */
    public function create(array $validated)
    {
        return $this->model->create(
            [
                'user_id' => Auth::user()->id,
                'organization_id' => (int)$validated['organization_id'],
                'name' => $validated['name'],
            ]
        );
    }

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Driver::class;
    }
}
