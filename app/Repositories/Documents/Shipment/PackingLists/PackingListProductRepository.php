<?php

namespace App\Repositories\Documents\Shipment\PackingLists;

use App\Models\Documents\Shipment\PackingLists\PackingListProduct as Model;
use App\Repositories\CoreRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class PackingListProductRepository extends CoreRepository
{
    /**
     * @return Collection
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getSeriesNumbers()
    {
        return $this->clone()
            ->select('series')
            ->whereBetween(
                'created_at',
                [
                    Carbon::now()->startOfMonth(),
                    Carbon::now()->endOfMonth()
                ]
            )
            ->groupBy('series')
            ->orderBy('series')
            ->get();
    }

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}
