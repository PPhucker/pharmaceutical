<?php

use App\Http\Controllers\Classifiers\Nomenclature\Materials\TypeOfMaterialController as Controller;
use Illuminate\Support\Facades\Route;

Route::resource('types_of_materials', Controller::class)
    ->only(['index', 'store', 'update']);
