<?php

use App\Http\Controllers\Contractor\Transport\TrailerController as Controller;

Route::resource('trailers', Controller::class)
    ->except(['create', 'edit', 'show', 'index']);
Route::controller(Controller::class)->group(static function () {
    Route::post('/trailer/{trailer}/restore', 'restore')
        ->name('trailers.restore')
        ->withTrashed();
});
