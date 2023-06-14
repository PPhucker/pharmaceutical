<?php

use App\Http\Controllers\Admin\Organizations\OrganizationController as Controller;
use Illuminate\Support\Facades\Route;

Route::controller(Controller::class)
    ->group(static function () {
        require_once __DIR__ . '/organizations.php';
    });

Route::prefix('organizations')
    ->group(static function () {
        require_once __DIR__ . '/places_of_business.php';
        require_once __DIR__ . '/bank_account_details.php';
        require_once __DIR__ . '/staff.php';
        require_once __DIR__ . '/drivers.php';
        require_once __DIR__ . '/cars.php';
        require_once __DIR__ . '/trailers.php';
    });
