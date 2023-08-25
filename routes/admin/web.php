<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->group(static function () {
        require_once __DIR__ . '/users.php';
        require_once __DIR__ . '/logs.php';
        require_once __DIR__ . '/organizations/web.php';
    });
