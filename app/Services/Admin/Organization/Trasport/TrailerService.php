<?php

namespace App\Services\Admin\Organization\Trasport;

/**
 * Сервис трейлера организации.
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
