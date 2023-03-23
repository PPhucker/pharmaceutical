<?php

namespace App\Observers\Classifiers\Nomenclature\Products;

use App\Logging\Logger;
use App\Models\Classifiers\Nomenclature\Products\TypeOfAggregation;

class TypeOfAggregationObserver
{
    /**
     * Handle the TypeOfAggregation "created" event.
     *
     * @param TypeOfAggregation $typeOfAggregation
     *
     * @return void
     */
    public function created(TypeOfAggregation $typeOfAggregation)
    {
        Logger::userActionNotice('create', $typeOfAggregation);
    }

    /**
     * Handle the TypeOfAggregation "updated" event.
     *
     * @param TypeOfAggregation $typeOfAggregation
     *
     * @return void
     */
    public function updated(TypeOfAggregation $typeOfAggregation)
    {
        Logger::userActionNotice('update', $typeOfAggregation);
    }
}
