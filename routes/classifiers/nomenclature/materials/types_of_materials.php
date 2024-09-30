<?php

use App\Http\Controllers\Classifier\Nomenclature\Material\TypeOfMaterialController as Controller;
use Illuminate\Support\Facades\Route;

Route::resource('types_of_materials', Controller::class)
    ->parameters(['types_of_materials' => 'type_of_material'])
    ->only(['index', 'store', 'update']);
