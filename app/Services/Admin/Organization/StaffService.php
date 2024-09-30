<?php

namespace App\Services\Admin\Organization;

use App\Repositories\Admin\Organization\StaffRepository;
use App\Services\CrudService;
use App\Traits\Repository\SoftDeletesTrait;
use Illuminate\Contracts\Container\BindingResolutionException;

/**
 * Сервис сотрудника организации.
 */
class StaffService extends CrudService
{
    use SoftDeletesTrait;

    public function __construct()
    {
        $this->selectedRepo = $this->selectRepository();
    }

    /**
     * @return object
     * @throws BindingResolutionException
     */
    protected function selectRepository(): object
    {
        return app()->make(StaffRepository::class);
    }

    /**
     * @return array
     */
    public function getIndexData(): array
    {
        return [];
    }
}
