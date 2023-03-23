<?php

namespace App\Repositories\Classifiers\Nomenclature\Products;

use App\Repositories\Admin\Organizations\OrganizationRepository;
use App\Repositories\Admin\Organizations\PlaceOfBusinessRepository;
use App\Repositories\Classifiers\Nomenclature\Materials\MaterialRepository;
use App\Repositories\CoreRepository;
use App\Models\Classifiers\Nomenclature\Products\ProductCatalog as Model;
use Illuminate\Support\Collection;

class ProductCatalogRepository extends CoreRepository
{

    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
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
                'end_products' => (new EndProductRepository())->getAll(),
                'materials' => (new MaterialRepository())->getAll(),
                'aggregation_types' => (new TypeOfAggregationRepository())->getAll(),
                'places_of_business' => (new PlaceOfBusinessRepository())->getAll(),
                'organizations' => (new OrganizationRepository())->getAll(),
            ]
        );
    }
}
