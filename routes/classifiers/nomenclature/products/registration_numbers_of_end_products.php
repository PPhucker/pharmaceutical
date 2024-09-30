<?php

use App\Http\Controllers\Classifier\Nomenclature\Product\RegistrationNumberOfEndProductController as Controller;
use Illuminate\Support\Facades\Route;

Route::resource('registration_numbers', Controller::class)
    ->only(['index', 'store', 'update']);
