<?php

use App\Http\Controllers\Classifiers\BankController as Controller;
use Illuminate\Support\Facades\Route;

Route::resource('banks', Controller::class)
    ->only(['index', 'store']);

Route::patch('banks/update', [Controller::class, 'update'])
    ->name('banks.update');
