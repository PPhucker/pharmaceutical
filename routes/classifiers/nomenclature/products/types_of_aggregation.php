<?php

use App\Http\Controllers\Classifier\Nomenclature\Product\Type\TypeOfAggregationController as Controller;
use Illuminate\Support\Facades\Route;

Route::resource('types_of_aggregation', Controller::class)
    ->parameters(['types_of_aggregation' => 'type_of_aggregation'])
    ->only(['index', 'store', 'update']);
