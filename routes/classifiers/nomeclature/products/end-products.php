<?php

use App\Http\Controllers\Classifiers\Nomenclature\Products\EndProductController as Controller;
use Illuminate\Support\Facades\Route;

Route::resource('end_products', Controller::class)
    ->except(['show']);
Route::controller(Controller::class)
    ->group(static function () {
        Route::post('/end_products/{end_product}/restore', 'restore')
            ->name('end_products.restore')
            ->withTrashed();
    });
