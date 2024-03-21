<?php

use App\Helpers\Route\RouteHelper;
use App\Http\Controllers\Admin\Organization\Transport\DriverController as Controller;

RouteHelper::mapWritableRoutes(
    collect(
        [
            'controller' => Controller::class,
            'name' => 'drivers',
            'uriParameter' => 'driver',
            'prefix' => 'organization',
        ]
    )
);
