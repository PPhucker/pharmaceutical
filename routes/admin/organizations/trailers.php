<?php

use App\Http\Controllers\Admin\Organizations\TrailerController as Controller;

Route::resource('trailers', Controller::class)
    ->except(['create', 'edit', 'show', 'index']);
Route::controller(Controller::class)->group(static function () {
    Route::post('/trailer/{trailers}/restore', 'restore')
        ->name('trailers.restore')
        ->withTrashed();
});
