<?php

use App\Http\Controllers\Documents\Acts\ActController as Controller;

Route::prefix('acts')->group(static function () {
    require_once __DIR__ . '/acts_services.php';
});

Route::resource('acts', Controller::class);
Route::controller(Controller::class)->group(static function () {
    Route::post('/acts/{act}/restore', 'restore')
        ->name('acts.restore')
        ->withTrashed();
});
