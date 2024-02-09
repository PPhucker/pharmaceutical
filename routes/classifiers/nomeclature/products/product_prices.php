<?php


use App\Http\Controllers\Classifier\Nomenclature\Product\ProductPriceController as Controller;
use Illuminate\Support\Facades\Route;

Route::resource('product_prices', Controller::class)
    ->only(['store', 'update', 'destroy']);
Route::controller(Controller::class)
    ->group(static function () {
        Route::post('/prices/{product_price}/restore', 'restore')
            ->name('product_prices.restore')
            ->withTrashed();
    });
