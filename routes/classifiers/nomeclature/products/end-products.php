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
        Route::patch('/end_products/{end_product}/attach_material', 'attachMaterial')
            ->name('end_products.attach_material');
        Route::patch('/end_products/{end_product}/detach_material', 'detachMaterial')
            ->name('end_products.detach_material');
        Route::patch('/end_products/{end_product}/attach_aggregation_type', 'attachAggregationType')
            ->name('end_products.attach_aggregation_type');
        Route::patch('/end_products/{end_product}/detach_aggregation_type', 'detachAggregationType')
            ->name('end_products.detach_aggregation_type');
        Route::patch('/end_products/{end_product}/update_product_quantity', 'updateProductQuantity')
            ->name('end_products.update_product_quantity');
    });
