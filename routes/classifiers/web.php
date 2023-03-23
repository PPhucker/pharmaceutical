<?php

use Illuminate\Support\Facades\Route;

Route::prefix('classifiers')->group(static function () {
    require_once __DIR__ . '/legal-forms.php';
    require_once __DIR__ . '/banks.php';
    require_once __DIR__. '/nomeclature/web.php';
});
