<?php


use App\Http\Controllers\Classifiers\Nomenclature\Products\TypeOfAggregationController as Controller;
use Illuminate\Support\Facades\Route;

Route::resource('types_of_aggregation', Controller::class)
    ->only(['index', 'store', 'update']);
