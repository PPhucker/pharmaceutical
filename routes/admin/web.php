<?php

use Illuminate\Support\Facades\Route;

Route::middleware('admin')
    ->group(static function () {
        require_once __DIR__ . '/users.php';
        require_once __DIR__ . '/logs.php';
    });
