<?php

use App\Http\Controllers\Classifier\LegalFormController as Controller;
use Illuminate\Support\Facades\Route;

Route::resource('legal_forms', Controller::class)
    ->only(['index', 'store', 'update']);
