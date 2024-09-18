<?php

use App\Helpers\Route\RouteHelper;
use App\Http\Controllers\Classifier\Nomenclature\Product\Catalog\Price\ProductPriceController;
use App\Http\Controllers\Classifier\Nomenclature\Product\Catalog\Price\WholesalePriceController;

$priceRoutesData = collect(
    [
        collect([
            'controller' => ProductPriceController::class,
            'name' => 'product_prices',
            'uriParameter' => 'product_price',
        ]),
        collect([
            'controller' => WholesalePriceController::class,
            'name' => 'wholesale_prices',
            'uriParameter' => 'wholesale_price',
        ]),
    ]
);

foreach ($priceRoutesData as $priceRouteData) {
    $routeHelper = new RouteHelper(collect($priceRouteData));
    $routeHelper->mapWritableRoutes();
}
