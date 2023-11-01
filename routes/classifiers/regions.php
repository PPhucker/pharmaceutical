<?php

use App\Http\Controllers\Classifiers\RegionController as Controller;
use Illuminate\Support\Facades\Route;

Route::resource('regions', Controller::class)
    ->only(['index', 'store', 'update']);
