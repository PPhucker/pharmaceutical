<?php


use App\Http\Controllers\Classifier\Nomenclature\Product\Type\TypeOfAggregationController as Controller;
use Illuminate\Support\Facades\Route;

Route::resource('types_of_aggregation', Controller::class)
    ->only(['index', 'store', 'update']);
