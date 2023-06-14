<?php

use Illuminate\Support\Facades\Route;

Route::prefix('nomenclature')->group(static function () {
    require_once __DIR__ . '/products/web.php';
    require_once __DIR__ . '/materials/web.php';
    require_once __DIR__ . '/okei.php';
    require_once __DIR__ . '/services/web.php';
});
