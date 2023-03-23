<?php

use App\Http\Controllers\Classifiers\Nomenclature\Products\InternationalNameOfEndProductController as Controller;
use Illuminate\Support\Facades\Route;

Route::resource('international_names', Controller::class)
    ->only(['index', 'store', 'update']);
