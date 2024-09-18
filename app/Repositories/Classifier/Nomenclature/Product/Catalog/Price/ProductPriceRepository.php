<?php

namespace App\Repositories\Classifier\Nomenclature\Product\Catalog\Price;

use App\Models\Classifier\Nomenclature\Product\Catalog\Price\ProductPrice;
use App\Repositories\CrudRepository;
use Auth;
use Illuminate\Database\Eloquent\Collection;

/**
 * Репозиторий розничных цен готовой продукции.
 */
class ProductPriceRepository extends CrudRepository
{
    /**
     * @inheritDoc
     */
    public function getAll(): Collection
    {
        return $this->clone()
            ->withTrashed()
            ->get();
    }

    /**
     * @param array $validated
     *
     * @return mixed
     */
    public function create(array $validated)
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
        return array_merge(
            [
                'user_id' => Auth::user()->id,
                'product_catalog_id' => $validated['product_catalog_id'],
                'organization_id' => $validated['organization_id'],
            ],
            $this->getFilledPrice($validated)
        );
    }

    /**
     * @param array $validated
     *
     * @return float[]
     */
    protected function getFilledPrice(array $validated): array
    {
        return [
            'price' => (float)$validated['price'],
            'nds' => (float)((int)$validated['nds'] / 100),
        ];
    }

    /**
     * @param       $model
     * @param array $validated
     *
     * @return void
     */
    public function update($model, array $validated): void
    {
        $this->model->findOrFail($validated['id'])
            ->fill(
                $this->getFilled($validated)
            )
            ->save();
    }

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return ProductPrice::class;
    }
}
