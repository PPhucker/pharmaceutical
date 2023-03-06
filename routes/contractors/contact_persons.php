<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Contractors\ContactPersonController as Controller;

Route::resource('contact_persons', Controller::class)
    ->except(['create', 'edit', 'show', 'index']);
Route::controller(Controller::class)->group(static function () {
    Route::post('/contact_persons/{contact_person}/restore', 'restore')
        ->name('contact_persons.restore')
        ->withTrashed();
});
