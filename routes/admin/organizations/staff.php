<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Organizations\StaffController as Controller;

Route::resource('staff', Controller::class)
    ->except(['create', 'edit', 'show', 'update', 'index']);
Route::controller(Controller::class)->group(static function () {
    Route::patch('/staff/update', 'update')
        ->name('staff.update');
    Route::post('/staff/{staff}/restore', 'restore')
        ->name('staff.restore')
        ->withTrashed();
});
