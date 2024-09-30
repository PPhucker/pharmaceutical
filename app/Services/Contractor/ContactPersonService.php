<?php

namespace App\Services\Contractor;

use App\Repositories\Contractor\ContactPersonRepository;
use App\Services\CrudService;
use App\Traits\Repository\SoftDeletesTrait;
use Illuminate\Contracts\Container\BindingResolutionException;

/**
 * Сервис контактого лица контрагента.
 */
class ContactPersonService extends CrudService
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
     * @return object
     * @throws BindingResolutionException
     */
    protected function selectRepository(): object
    {
        return app()->make(ContactPersonRepository::class);
    }

    /**
     * @return array
     */
    public function getIndexData(): array
    {
        return [];
    }
}
