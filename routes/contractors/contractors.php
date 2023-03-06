<?php

use App\Http\Controllers\Contractors\ContractorController as Controller;

Route::resource('contractors', Controller::class)
    ->except(['show']);
Route::controller(Controller::class)->group(static function () {
    Route::post('/contractors/{contractor}/restore', 'restore')
        ->name('contractors.restore')
        ->withTrashed();
});
