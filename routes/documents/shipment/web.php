<?php

Route::prefix('shipment')->group(static function () {
    require_once  __DIR__ . '/packing_lists.php';
    require_once __DIR__ . '/packing_lists_production.php';
});