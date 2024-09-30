<?php

namespace App\Interfaces\Service;

interface SoftDeletesServiceInterface
{
    /**
     * @param $model
     */
    public function delete($model);

    /**
     * @param $model
     */
    public function restore($model);
}
