<?php

use App\Http\Controllers\Classifiers\Nomenclature\Products\ProductCatalogController as Controller;
use Illuminate\Support\Facades\Route;

Route::resource('product_catalog', Controller::class)
    ->except(['show']);
Route::controller(Controller::class)
    ->group(static function () {
        Route::post('/product_catalog/{product_catalog}/restore', 'restore')
            ->name('product_catalog.restore')
            ->withTrashed();
        Route::patch('/product_catalog/{product_catalog}/attach_material', 'attachMaterial')
            ->name('product_catalog.attach_material');
        Route::patch('/product_catalog/{product_catalog}/detach_material', 'detachMaterial')
            ->name('product_catalog.detach_material');
        Route::patch('/product_catalog/{product_catalog}/attach_aggregation_type', 'attachAggregationType')
            ->name('product_catalog.attach_aggregation_type');
        Route::patch('/product_catalog/{product_catalog}/detach_aggregation_type', 'detachAggregationType')
            ->name('product_catalog.detach_aggregation_type');
        Route::patch('/product_catalog/{product_catalog}/update_product_quantity', 'updateProductQuantity')
            ->name('product_catalog.update_product_quantity');
        Route::get('/product_catalog/{product_catalog}/statistic', 'statistic')
            ->name('product_catalog.statistic');
    });
