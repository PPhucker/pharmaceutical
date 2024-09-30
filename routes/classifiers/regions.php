<?php

use App\Http\Controllers\Classifier\RegionController as Controller;
use Illuminate\Support\Facades\Route;

Route::resource('regions', Controller::class)
    ->only(['index', 'store', 'update']);
