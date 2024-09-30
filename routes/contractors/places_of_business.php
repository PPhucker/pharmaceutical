<?php

use App\Helpers\Route\RouteHelper;
use App\Http\Controllers\Contractor\PlaceOfBusinessController as Controller;

(new RouteHelper(
    collect(
        [
            'controller' => Controller::class,
            'name' => 'places_of_business',
            'uriParameter' => 'place_of_business',
        ]
    )
))->mapWritableRoutes();
