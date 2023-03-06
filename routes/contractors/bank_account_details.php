<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Contractors\BankAccountDetailController as Controller;

Route::resource('bank_account_details', Controller::class)
    ->except(['create', 'edit', 'show', 'index']);
Route::controller(Controller::class)->group(static function () {
    Route::post('/bank_account_details/{bank_account_detail}/restore', 'restore')
        ->name('bank_account_details.restore')
        ->withTrashed();
});
