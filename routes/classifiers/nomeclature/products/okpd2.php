<?php

use App\Http\Controllers\Classifier\Nomenclature\Product\OKPD2Controller as Controller;
use Illuminate\Support\Facades\Route;

Route::resource('okpd2', Controller::class)
    ->only(['index', 'store', 'update']);
