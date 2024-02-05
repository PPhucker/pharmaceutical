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

    /**
     * @param StaffRepository $staff
     */
    public function __construct(StaffRepository $staff)
    {
        $this->selectedRepo = $staff;
    }
}
