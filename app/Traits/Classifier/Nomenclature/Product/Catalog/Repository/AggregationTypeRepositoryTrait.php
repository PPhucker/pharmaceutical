<?php

namespace App\Traits\Classifier\Nomenclature\Product\Catalog\Repository;

use App\Traits\Repository\BelongsToManyRepositoryTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Трейт для работы с типами агрегации готового продукта из каталога.
 */
trait AggregationTypeRepositoryTrait
{
    use BelongsToManyRepositoryTrait;

    /**
     * @param BelongsToMany $target
     * @param array         $validated
     *
     * @return void
     */
    public function attachAggregationType(BelongsToMany $target, array $validated): void
    {
        $options = [
            $validated['aggregation_type'] => ['product_quantity' => (int)$validated['product_quantity']],
        ];

        $this->attach($target, $options);
    }

    /**
     * @param BelongsToMany $target
     * @param array         $validated
     *
     * @return void
     */
    public function detachAggregationType(BelongsToMany $target, array $validated): void
    {
        $options = [
            $validated['aggregation_type'],
        ];

        $this->detach($target, $options);
    }

    /**
     * @param BelongsToMany $target
     * @param array         $validated
     *
     * @return void
     */
    public function updateAggregationTypeProductQuantity(BelongsToMany $target, array $validated): void
    {
        foreach ($validated as $validatedAggregationType) {
            $this->updateExistingPivot(
                $target,
                $validatedAggregationType['aggregation_type'],
                ['product_quantity' => (int)$validatedAggregationType['product_quantity']]
            );
        }
    }

    /**
     * @param string $type
     *
     * @return int
     */
    public function getAggregationTypeProductQuantity(string $type): int
    {
        $aggregationType = $this->model->aggregationTypes
            ->where('product_catalog_types_of_aggregation.aggregation_type', $type)
            ->first();

        if (!$aggregationType) {
            return 1;
        }

        return $aggregationType
            ->pivot
            ->product_quantity;
    }
}
