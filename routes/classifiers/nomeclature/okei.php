<?php

use App\Http\Controllers\Classifiers\Nomenclature\OKEIController as Controller;
use Illuminate\Support\Facades\Route;

Route::resource('okei', Controller::class)
    ->only(['index', 'store', 'update']);
