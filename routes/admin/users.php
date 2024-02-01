<?php

use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::resource('users', UserController::class)
    ->except('show');

Route::get('/users/register', [RegisterController::class, 'showRegistrationForm'])
    ->name('users.register');

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
