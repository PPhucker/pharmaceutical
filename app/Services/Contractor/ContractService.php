<?php

namespace App\Services\Contractor;

use App\Repositories\Contractor\ContractRepository;
use App\Services\CrudService;
use App\Traits\Repository\SoftDeletesTrait;
use Illuminate\Contracts\Container\BindingResolutionException;

/**
 * Сервис договора с контрагентом.
 */
class ContractService extends CrudService
{
    use SoftDeletesTrait;

    /**
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->selectedRepo = $this->selectRepository();
    }

    /**
     * @return array
     */
    public function getIndexData(): array
    {
        return [];
    }

    /**
     * @return object
     * @throws BindingResolutionException
     */
    protected function selectRepository(): object
    {
        return app()->make(ContractRepository::class);
    }
}
