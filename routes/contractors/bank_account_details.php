<?php

use App\Helpers\Route\RouteHelper;
use App\Http\Controllers\Contractor\BankAccountDetailController as Controller;

(new RouteHelper(
    collect(
        [
            'controller' => Controller::class,
            'name' => 'bank_account_details',
            'uriParameter' => 'bank_account_detail',
        ]
    )
))->mapWritableRoutes();
