<?php

use Illuminate\Support\Facades\Route;

Route::prefix('products')->group(static function () {
    require_once __DIR__ . '/types_of_end_products.php';
    require_once __DIR__ . '/international_names_of_end_products.php';
    require_once __DIR__ . '/okpd2.php';
    require_once __DIR__ . '/registration_numbers_of_end_products.php';
    require_once __DIR__ . '/end-products.php';
    require_once __DIR__ . '/types_of_aggregation.php';
    require_once __DIR__ . '/product_catalog.php';
    require_once __DIR__ . '/product_prices.php';
    require_once __DIR__ . '/product_regional_allowances.php';
});
