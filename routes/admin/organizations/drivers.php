<?php

use App\Helpers\Route\RouteHelper;
use App\Http\Controllers\Admin\Organization\Transport\DriverController as Controller;

(new RouteHelper(
    collect(
        [
            'controller' => Controller::class,
            'name' => 'drivers',
            'uriParameter' => 'driver',
            'prefix' => 'organization',
        ]
    )
))->mapWritableRoutes();
