<?php

use App\Http\Controllers\Contractors\ContractorController as Controller;
use Illuminate\Support\Facades\Route;

Route::controller(Controller::class)
    ->group(static function () {
        require_once __DIR__ . '/contractors.php';
    });

Route::prefix('contractors')
    ->group(static function () {
        require_once __DIR__ . '/places_of_business.php';
        require_once __DIR__ . '/bank_account_details.php';
        require_once __DIR__ . '/contact_persons.php';
        require_once __DIR__ . '/drivers.php';
    });
