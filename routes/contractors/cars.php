<?php

use App\Helpers\Route\RouteHelper;
use App\Http\Controllers\Contractor\Transport\CarController as Controller;

(new RouteHelper(
    collect(
        [
            'controller' => Controller::class,
            'name' => 'cars',
            'uriParameter' => 'car',
        ]
    )
))->mapWritableRoutes();
