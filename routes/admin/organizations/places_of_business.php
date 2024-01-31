<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Organization\PlaceOfBusinessController as Controller;

Route::delete('/places_of_business/{place_of_business}', [Controller::class, 'destroy'])
    ->name('organization.places_of_business.destroy');

Route::post('/places_of_business', [Controller::class, 'store'])
    ->name('organization.places_of_business.store');

Route::patch('/places_of_business/{place_of_business}', [Controller::class, 'update'])
    ->name('organization.places_of_business.update');

Route::post('/places_of_business/{place_of_business}/restore', [Controller::class, 'restore'])
    ->name('organization.places_of_business.restore')
    ->withTrashed();

Route::get('/places_of_business/staff/{place_of_business}', [Controller::class, 'getStaff']);
