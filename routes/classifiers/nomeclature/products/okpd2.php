<?php

use App\Http\Controllers\Classifiers\Nomenclature\Products\OKPD2Controller as Controller;
use Illuminate\Support\Facades\Route;

Route::resource('okpd2', Controller::class)
    ->only(['index', 'store', 'update']);
