<?php

namespace App\Services\Contractor\Transport;

use App\Services\CrudService;
use App\Traits\Repository\SoftDeletesTrait;

/**
 * Сервис прицепа контр агента.
 */
class TrailerService extends TransportService
{
    /**
     * @return object
     */
    protected function selectRepository(): object
    {
        return $this->repositories->trailer;
    }
}
