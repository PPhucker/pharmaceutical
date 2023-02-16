<?php

use App\Http\Controllers\Classifiers\LegalFormController as Controller;
use Illuminate\Support\Facades\Route;

Route::resource('legal_forms', Controller::class)
    ->only(['index', 'store']);

Route::patch('legal_forms/update', [Controller::class, 'update'])
    ->name('legal_forms.update');
