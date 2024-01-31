<?php

namespace App\Repositories\Classifiers\Nomenclature\Products;

use App\Models\Classifiers\Nomenclature\Products\ProductCatalog as Model;
use App\Models\Documents\InvoicesForPayment\InvoiceForPayment;
use App\Models\Documents\InvoicesForPayment\InvoiceForPaymentProduct;
use App\Repositories\Admin\Organization\OrganizationRepository;
use App\Repositories\Admin\Organization\PlaceOfBusinessRepository;
use App\Repositories\Classifiers\Nomenclature\Materials\MaterialRepository;
use App\Repositories\CoreRepository;
use Illuminate\Database\Eloquent\Collection;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Репозиторий готовой продукции.
 */
class ProductCatalogRepository extends CoreRepository
{
    /**
     * @param int $id
     *
     * @return \Illuminate\Support\Collection
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getForEdit(int $id): \Illuminate\Support\Collection
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
                'regionalAllowances' => static function ($query) {
                    $query->orderBy('region_id');
                }
            ]
        );

        return collect(
            [
                'product' => $product,
                'end_products' => (new EndProductRepository())
                    ->getAll(false),
                'materials' => (new MaterialRepository())
                    ->getAll(false),
                'aggregation_types' => (new TypeOfAggregationRepository())
                    ->getAll(false),
                'places_of_business' => (new PlaceOfBusinessRepository())
                    ->getAll(false),
                'organizations' => (new OrganizationRepository())
                    ->getAll(false),
            ]
        );
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
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
            ->with('prices')
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
    public function getProductCatalog(float $nds = 0, array $invoiceProducts = []): Collection
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
                        'full_name',
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
            ->sortBy('endProduct.full_name');
    }

    /**
     * @param InvoiceForPayment $invoiceForPayment
     * @param int               $productCatalogId
     * @param int               $quantity
     *
     * @return \Illuminate\Support\Collection
     */
    public function getPriceList(
        InvoiceForPayment $invoiceForPayment,
        int $productCatalogId,
        int $quantity
    ): \Illuminate\Support\Collection {
        $productCatalog = $this->clone()->find($productCatalogId);

        $priceList = $productCatalog->prices->where(
            'organization_id',
            $invoiceForPayment->organization_id
        )
            ->first();

        $price = 0;

        $nds = $priceList ? $priceList->nds : 0;

        $regionalAllowance = $productCatalog->regionalAllowances
            ->where(
                'product_catalog_id',
                $productCatalogId
            )
            ->where(
                'region_id',
                $invoiceForPayment->contractorPlaceOfBusiness->region_id
            )
            ->first();

        $allowance = $regionalAllowance ? $regionalAllowance->allowance : 0;

        if (!$priceList) {
            return collect(
                compact('price', 'nds', 'allowance')
            );
        }

        /**
         * Если кол-во в документе больше или равно оптовому кол-ву в прайсе и существует оптовая цена
         */
        if ($quantity >= $priceList->trade_quantity && $priceList->trade_price) {
            $price = $priceList->trade_price;
        } else {
            $price = $priceList->retail_price;
        }

        return collect(
            compact('price', 'nds', 'allowance')
        );
    }

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return Model::class;
    }
}
