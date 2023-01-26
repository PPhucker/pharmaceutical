<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/users/register', [RegisterController::class, 'showRegistrationForm'])
    ->name('users.register');

Route::resource('users', UserController::class)
    ->except('show');

Route::controller(UserController::class)->group(static function () {
    Route::post('/users/{user}/restore', 'restore')
        ->name('users.restore')
        ->withTrashed();
    Route::post('/users/{user}/force/delete', 'forceDelete')
        ->name('users.force.delete')
        ->withTrashed();
    Route::get('/users/{role}', 'show')
        ->name('users.show');
});
