<?php

use App\Http\Controllers\Classifiers\Nomenclature\Products\TypeOfEndProductController as Controller;
use Illuminate\Support\Facades\Route;

Route::resource('types_of_end_products', Controller::class)
    ->only(['index', 'store', 'update']);
