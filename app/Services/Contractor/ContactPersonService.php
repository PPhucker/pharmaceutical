<?php

namespace App\Services\Contractor;

use App\Repositories\Contractor\ContactPersonRepository;
use App\Services\CrudService;
use App\Traits\Repository\SoftDeletesTrait;

/**
 * Сервис контактого лица контрагента.
 */
class ContactPersonService extends CrudService
{
    use SoftDeletesTrait;

    /**
     * @param ContactPersonRepository $contactPerson
     */
    public function __construct(ContactPersonRepository $contactPerson)
    {
        $this->selectedRepo = $contactPerson;
    }
}
