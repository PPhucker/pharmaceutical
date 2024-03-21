<?php

use App\Http\Controllers\Documents\Acts\ActController as Controller;

Route::resource('acts', Controller::class)
    ->except(['show']);

Route::controller(Controller::class)->group(static function () {
    Route::post('/acts/{act}/restore', 'restore')
        ->name('acts.restore')
        ->withTrashed();
});
