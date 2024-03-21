<?php

use App\Http\Controllers\Admin\Log\LogController;

Route::get('/logs', [LogController::class, 'index'])
    ->name('logs.index');
