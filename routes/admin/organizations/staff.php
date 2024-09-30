<?php

use App\Helpers\Route\RouteHelper;
use App\Http\Controllers\Admin\Organization\StaffController as Controller;

(new RouteHelper(
    collect(
        [
            'controller' => Controller::class,
            'name' => 'staff',
            'uriParameter' => 'staff',
            'prefix' => 'organization',
        ]
    )
))->mapWritableRoutes();
