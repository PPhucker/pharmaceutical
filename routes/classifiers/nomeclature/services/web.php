<?php

use App\Http\Controllers\Classifier\Nomenclature\ServiceController as Controller;

Route::resource('services', Controller::class)
    ->except(['show', 'edit', 'create']);
Route::controller(Controller::class)->group(static function () {
    Route::post('/services/{service}/restore', 'restore')
        ->name('services.restore')
        ->withTrashed();
});
