<?php

use App\Helpers\Route\RouteHelper;
use App\Http\Controllers\Classifier\Nomenclature\ServiceController as Controller;

(new RouteHelper(
    collect(
        [
            'controller' => Controller::class,
            'name' => 'services',
            'uriParameter' => 'service'
        ]
    )
))
    ->mapWritableRoutes()
    ->mapIndexRoute();
