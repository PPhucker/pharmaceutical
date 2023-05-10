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
     * @param int $id
     *
     * @return Collection
     */
    public function getFullInfo(int $id)
    {
        $packingListProduct = $this->model::find($id);

        $packingListProduct->load(
            [
                'productCatalog' => static function ($query) {
                    $query->select(
                        [
                            'id',
                            'product_id',
                            'GTIN',
                            'organization_id',
                        ]
                    )
                        ->with(
                            [
                                'endProduct' => static function ($query) {
                                    $query->select(
                                        [
                                            'id',
                                            'international_name_id',
                                            'registration_number_id',
                                            'okei_code',
                                            'okpd2_code',
                                            'full_name',
                                            'best_before_date',
                                        ]
                                    )
                                        ->with(
                                            [
                                                'internationalName:id,name',
                                                'registrationNumber:id,number',
                                                'okei:code,unit,symbol',
                                                'okpd2:code,name',

                                            ]
                                        );
                                },
                            ]
                        );
                },
            ]
        )
            ->first();

        return $packingListProduct;
    }

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}
