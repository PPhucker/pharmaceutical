<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Organization\BankAccountDetailController as Controller;

Route::delete('/bank_account_details/{bank_account_detail}', [Controller::class, 'destroy'])
    ->name('organization.bank_account_details.destroy');

Route::post('/bank_account_details', [Controller::class, 'store'])
    ->name('organization.bank_account_details.store');

Route::patch('/bank_account_details/{bank_account_detail}', [Controller::class, 'update'])
    ->name('organization.bank_account_details.update');

Route::post('/bank_account_details/{bank_account_detail}/restore', [Controller::class, 'restore'])
    ->name('organization.bank_account_details.restore')
    ->withTrashed();
