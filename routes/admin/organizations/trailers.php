<?php

use App\Helpers\Route\RouteHelper;
use App\Http\Controllers\Admin\Organization\Transport\TrailerController as Controller;

RouteHelper::mapWritableRoutes(
    collect(
        [
            'controller' => Controller::class,
            'name' => 'trailers',
            'uriParameter' => 'trailer',
            'prefix' => 'organization',
        ]
    )
);
