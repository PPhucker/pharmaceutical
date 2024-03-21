<?php

use App\Helpers\Route\RouteHelper;
use App\Http\Controllers\Admin\Organization\Transport\CarController as Controller;

RouteHelper::mapWritableRoutes(
    collect(
        [
            'controller' => Controller::class,
            'name' => 'cars',
            'uriParameter' => 'car',
            'prefix' => 'organization',
        ]
    )
);
