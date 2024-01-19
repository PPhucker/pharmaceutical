<?php

use App\Http\Controllers\Contractor\ContractController as Controller;

Route::resource('contracts', Controller::class)
    ->except(['create', 'edit', 'show', 'index']);
Route::controller(Controller::class)->group(static function () {
    Route::post('/contracts/{contract}/restore', 'restore')
        ->name('contracts.restore')
        ->withTrashed();
});
