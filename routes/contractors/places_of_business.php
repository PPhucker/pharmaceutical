<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Contractors\PlaceOfBusinessController as Controller;

Route::resource('places_of_business', Controller::class)
    ->parameters(['places_of_business' => 'place_of_business'])
    ->except(['create', 'edit', 'show', 'index']);
Route::controller(Controller::class)->group(static function () {
    Route::post('/places_of_business/{place_of_business}/restore', 'restore')
        ->name('places_of_business.restore')
        ->withTrashed();
});
