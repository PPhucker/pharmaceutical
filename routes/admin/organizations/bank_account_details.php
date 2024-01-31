<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Organization\BankAccountDetailController as Controller;

Route::resource('bank_account_details', Controller::class)
    ->except(['create', 'edit', 'show', 'update', 'index']);
Route::controller(Controller::class)->group(static function () {
    Route::patch('/bank_account_details/update', 'update')
        ->name('organizations.bank_account_details.update');
    Route::post('/bank_account_details/{bank_account_detail}/restore', 'restore')
        ->name('bank_account_details.restore')
        ->withTrashed();
});
