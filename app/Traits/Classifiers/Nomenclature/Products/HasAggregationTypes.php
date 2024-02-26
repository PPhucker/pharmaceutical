<?php

namespace App\Traits\Classifiers\Nomenclature\Products;

use App\Logging\Logger;
use App\Models\Classifier\Nomenclature\Product\Type\TypeOfAggregation;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasAggregationTypes
{
    /**
     * @return BelongsToMany
     */
    public function aggregationTypes(): BelongsToMany
    {
        return $this->belongsToMany(
            TypeOfAggregation::class,
            'product_catalog_types_of_aggregation',
            'product_catalog_id',
            'aggregation_type'
        )
            ->withPivot('product_quantity');
    }

    /**
     * @param TypeOfAggregation $typeOfAggregation
     * @param int               $productQuantity
     *
     * @return HasAggregationTypes
     */
    public function attachAggregationType(TypeOfAggregation $typeOfAggregation, int $productQuantity)
    {
        $this->aggregationTypes()->attach(
            $typeOfAggregation->code,
            [
                'product_quantity' => $productQuantity
            ]
        );

        Logger::userActionNotice(
            'attach',
            $this,
            [
                'table' => 'product_catalog_types_of_aggregation',
                'id' => $typeOfAggregation->code
            ]
        );

        return $this;
    }

    /**
     * @param TypeOfAggregation $typeOfAggregation
     *
     * @return HasAggregationTypes
     */
    public function detachAggregationType(TypeOfAggregation $typeOfAggregation)
    {
        $this->aggregationTypes()->detach($typeOfAggregation->code);

        Logger::userActionNotice(
            'detach',
            $this,
            [
                'table' => 'product_catalog_types_of_aggregation',
                'id' => $typeOfAggregation->code
            ]
        );

        return $this;
    }

    /**
     * @return $this
     */
    public function getachAllAggregationTypes()
    {
        $this->aggregationTypes()->detach();
        return $this;
    }

    /**
     * @param string $type
     *
     * @return int
     */
    public function getQuantityInAggregationType(string $type)
    {
        $aggregationType = $this->aggregationTypes()
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
