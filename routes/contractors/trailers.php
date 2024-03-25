<?php

use App\Helpers\Route\RouteHelper;
use App\Http\Controllers\Contractor\Transport\TrailerController as Controller;

(new RouteHelper(
    collect(
        [
            'controller' => Controller::class,
            'name' => 'trailers',
            'uriParameter' => 'trailer',
        ]
    )
))->mapWritableRoutes();
