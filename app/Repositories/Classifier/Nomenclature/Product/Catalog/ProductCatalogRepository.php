<?php

namespace App\Repositories\Classifier\Nomenclature\Product\Catalog;

use App\Models\Admin\Organization\PlaceOfBusiness;
use App\Models\Classifier\Nomenclature\Product\Catalog\ProductCatalog;
use App\Models\Documents\InvoicesForPayment\InvoiceForPayment;
use App\Repositories\ResourceRepository;
use App\Traits\Classifier\Nomenclature\Product\Catalog\Repository\AggregationTypeRepositoryTrait;
use App\Traits\Classifier\Nomenclature\Product\Catalog\Repository\MaterialRepositoryTrait;
use Auth;
use Illuminate\Database\Eloquent\Collection;

/**
 * Репозиторий готовой продукции.
 */
class ProductCatalogRepository extends ResourceRepository
{
    use AggregationTypeRepositoryTrait;
    use MaterialRepositoryTrait;

    /**
     * @param int $id
     *
     * @return ProductCatalog
     */
    public function getForEdit(int $id): ProductCatalog
    {
        return $this->model
            ->findOrFail($id)
            ->load([
                'user' => function ($query) {
                    $query->select('id', 'name')
                        ->orderBy('name');
                },
                'endProduct' => function ($query) {
                    $query->orderBy('full_name');
                },
                'materials' => function ($query) {
                    $query->select('id', 'type_id', 'okei_code', 'name')
                        ->orderBy('name')
                        ->with('okei:code,symbol')
                        ->withoutTrashed();
                },
                'aggregationTypes' => function ($query) {
                    $query->select('code', 'name')
                        ->orderBy('code');
                },
                'prices' => function ($query) {
                    $query->with('organization:id,name')
                        ->orderBy('organization_id');
                },
                'regionalAllowances' => function ($query) {
                    $query->orderBy('region_id');
                }
            ]);
    }


    /**
     * @param bool $withTrashed
     *
     * @return Collection
     */
    public function getAll(bool $withTrashed = false): Collection
    {
        $productCatalog = $this->clone()
            ->select([
                'id',
                'organization_id',
                'place_of_business_id',
                'product_id',
                'GTIN',
                'deleted_at',
            ]);

        if ($withTrashed) {
            $productCatalog->withTrashed();
        }

        return $productCatalog->with([
            'endProduct:id,full_name',
            'organization:id,name,legal_form_type',
            'placeOfBusiness:id,address',
            'prices'
        ])
            ->get()
            ->sortBy([
                'place_of_production',
                'endProduct.full_name',
            ]);
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
            ->select([
                'id',
                'organization_id',
                'place_of_business_id',
                'product_id',
                'GTIN',
            ])
            ->with([
                'endProduct' => function ($query) {
                    $query->select('id', 'short_name', 'full_name', 'type_id')
                        ->with('type:id,color');
                },
                'organization:id,name',
                'placeOfBusiness:id,address',
            ]);

        if ($nds) {
            $catalog->whereHas(
                'prices',
                function ($query) use ($nds) {
                    $query->where('nds', '=', $nds);
                }
            );
        }

        if ($invoiceProducts) {
            $catalog->whereNotIn('product_catalog.id', $invoiceProducts);
        }

        return $catalog
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
        )->first();

        $price = $priceList ? ($quantity >= $priceList->trade_quantity && $priceList->trade_price
            ? $priceList->trade_price
            : $priceList->retail_price) : 0;

        $nds = $priceList->nds ?? 0;

        $regionalAllowance = $productCatalog->regionalAllowances
            ->where('product_catalog_id', $productCatalogId)
            ->where('region_id', $invoiceForPayment->contractorPlaceOfBusiness->region_id)
            ->first();

        $allowance = $regionalAllowance ? $regionalAllowance->allowance : 0;

        return collect(compact('price', 'nds', 'allowance'));
    }

    /**
     * @param array $validated
     *
     * @return ProductCatalog
     */
    public function create(array $validated): ProductCatalog
    {
        return $this->model->create(
            $this->getFilled($validated)
        );
    }

    /**
     * @param array $validated
     *
     * @return array
     */
    protected function getFilled(array $validated): array
    {
        $placeOfBusinessId = (int)$validated['place_of_business_id'];

        return [
            'user_id' => Auth::user()->id,
            'product_id' => (int)$validated['product_id'],
            'organization_id' => PlaceOfBusiness::find($placeOfBusinessId)->organization_id,
            'place_of_business_id' => $placeOfBusinessId,
            'GTIN' => $validated['GTIN'],
        ];
    }

    /**
     * @param       $model
     * @param array $validated
     *
     * @return ProductCatalog
     */
    public function update($model, array $validated): ProductCatalog
    {
        $model->fill(
            $this->getFilled($validated)
        )
            ->save();

        return $model;
    }

    /**
     * Возвращает Id комплектующих, из которых состоит продукт каталога.
     *
     * @param int $productCatalogId
     *
     * @return array
     */
    public function getMaterialsId(int $productCatalogId): array
    {
        return $this->model->find($productCatalogId)
            ->materials
            ->map(function ($material) {
                return $material->id;
            })
            ->toArray();
    }

    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return ProductCatalog::class;
    }
}
