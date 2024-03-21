<?php

use App\Helpers\Route\RouteHelper;
use App\Http\Controllers\Admin\Organization\BankAccountDetailController as Controller;

RouteHelper::mapWritableRoutes(
    collect(
        [
            'controller' => Controller::class,
            'name' => 'bank_account_details',
            'uriParameter' => 'bank_account_detail',
            'prefix' => 'organization',
        ]
    )
);
