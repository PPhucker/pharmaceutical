<?php

namespace App\Repositories\Classifiers\Nomenclature\Products;

use App\Models\Classifiers\Nomenclature\Products\ProductCatalog as Model;
use App\Repositories\Admin\Organizations\OrganizationRepository;
use App\Repositories\Admin\Organizations\PlaceOfBusinessRepository;
use App\Repositories\Classifiers\Nomenclature\Materials\MaterialRepository;
use App\Repositories\CoreRepository;
use Illuminate\Database\Eloquent\Collection;

class ProductCatalogRepository extends CoreRepository
{

    public function getForEdit(int $id)
    {
        $product = $this->model::find($id);

        $product->load(
            [
                'user' => static function ($query) {
                    $query->select(['id', 'name'])
                        ->orderBy('name');
                },
                'endProduct' => static function ($query) {
                    $query->select('*')
                        ->orderBy('full_name');
                },
                'materials' => static function ($query) {
                    $query->select(
                        [
                            'id',
                            'type_id',
                            'okei_code',
                            'name'
                        ]
                    )
                        ->withoutTrashed()
                        ->orderBy('type_id')
                        ->orderBy('name')
                        ->with('okei:code,symbol')
                        ->get();
                },
                'aggregationTypes' => static function ($query) {
                    $query->select(
                        [
                            'code',
                            'name',
                        ]
                    )
                        ->orderBy('code');
                },
                'prices' => static function ($query) {
                    $query->select('*')
                        ->with('organization:id,name')
                        ->orderBy('organization_id')
                        ->get();
                },
            ]
        );

        return collect(
            [
                'product' => $product,
                'end_products' => (new EndProductRepository())->getAll(false),
                'materials' => (new MaterialRepository())->getAll(false),
                'aggregation_types' => (new TypeOfAggregationRepository())->getAll(false),
                'places_of_business' => (new PlaceOfBusinessRepository())->getAll(false),
                'organizations' => (new OrganizationRepository())->getAll(false),
            ]
        );
    }

    /**
     * @return Collection
     */
    public function getAll()
    {
        return $this->clone()
            ->select(
                [
                    'product_catalog.id',
                    'product_catalog.organization_id',
                    'product_catalog.place_of_business_id',
                    'product_catalog.product_id',
                    'product_catalog.GTIN',
                    'product_catalog.deleted_at',
                ]
            )
            ->withTrashed()
            ->with('endProduct:id,full_name')
            ->with('organization:id,name')
            ->with('placeOfBusiness:id,address')
            ->get()
            ->sortBy('endProduct.full_name')
            ->sortBy('organization.name');
    }

    /**
     * @param float $nds
     * @param array $invoiceProducts
     *
     * @return Collection
     */
    public function getProductCatalog(float $nds = 0, array $invoiceProducts = [])
    {
        $catalog = $this->clone()
            ->select(
                [
                    'product_catalog.id',
                    'product_catalog.organization_id',
                    'product_catalog.place_of_business_id',
                    'product_catalog.product_id',
                    'product_catalog.GTIN',
                ]
            );

        if ($nds) {
            $catalog->whereHas(
                'prices',
                static function ($query) use ($nds) {
                    $query->where('nds', '=', $nds);
                }
            );
        }

        if ($invoiceProducts) {
            $catalog->whereNotIn('product_catalog.id', $invoiceProducts);
        }

        $catalog->with(
            [
                'endProduct' => static function ($query) {
                    $query->select(
                        'id',
                        'short_name',
                        'type_id',
                    )
                        ->with('type:id,color');
                },
            ]
        );

        return $catalog->with(
            [
                'organization:id,name',
                'placeOfBusiness:id,address',
            ]
        )
            ->get()
            ->sortBy('endProduct.short_name')
            ->sortBy('organization.name');
    }

    /**
     * @param int $organizationId
     * @param int $id
     * @param int $quantity
     *
     * @return \Illuminate\Support\Collection
     */
    public function getPriceList(int $organizationId, int $id, int $quantity)
    {
        $productCatalog = $this->clone()->find($id);

        $priceList = $productCatalog->prices->where(
            'organization_id',
            $organizationId
        )
            ->first();

        $nds = $priceList ? $priceList->nds : 0;

        if (!$priceList) {
            return collect(
                [
                    'price' => 0,
                    'nds' => $nds
                ]
            );
        }

        /**
         * Если кол-во в документе больше или равно оптовому кол-ву в прайсе и существует оптовая цена
         */
        if ($quantity >= $priceList->trade_quantity && $priceList->trade_price) {
            return collect(
                [
                    'price' => $priceList->traide_price,
                    'nds' => $nds,
                ]
            );
        }

        return collect(
            [
                'price' => $priceList->retail_price,
                'nds' => $nds,
            ]
        );
    }

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}
