<?php

use App\Http\Controllers\Classifier\Nomenclature\Product\Type\TypeOfEndProductController as Controller;
use Illuminate\Support\Facades\Route;

Route::resource('types_of_end_products', Controller::class)
    ->only(['index', 'store', 'update']);
