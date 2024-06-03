<?php

use App\Http\Controllers\Classifier\Nomenclature\Product\Catalog\Price\ProductRegionalAllowanceController as Controller;
use Illuminate\Support\Facades\Route;

Route::resource('product_regional_allowances', Controller::class)
    ->only(['store', 'update', 'destroy']);
Route::controller(Controller::class)
    ->group(static function () {
        Route::post('/prices/{product_regional_allowance}/restore', 'restore')
            ->name('product_regional_allowance.restore')
            ->withTrashed();
    });
