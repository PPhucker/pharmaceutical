<?php

use App\Http\Controllers\Classifier\Nomenclature\Material\TypeOfMaterialController as Controller;
use Illuminate\Support\Facades\Route;

Route::resource('types_of_materials', Controller::class)
    ->only(['index', 'store', 'update']);
