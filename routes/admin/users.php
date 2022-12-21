<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/users/register', [RegisterController::class, 'showRegistrationForm'])
    ->name('users.register');
