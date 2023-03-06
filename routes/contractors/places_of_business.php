<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Contractors\PlaceOfBusinessController as Controller;

Route::resource('places_of_business', Controller::class)
    ->except(['create', 'edit', 'show', /*'update',*/ 'index']);
Route::controller(Controller::class)->group(static function () {
    /*Route::patch('/places_of_business/update', 'update')
        ->name('places_of_business.update');*/
    Route::post('/places_of_business/{places_of_business}/restore', 'restore')
        ->name('places_of_business.restore')
        ->withTrashed();
});
