<?php

use App\Helpers\Route\RouteHelper;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Organization\PlaceOfBusinessController as Controller;

RouteHelper::mapWritableRoutes(
    collect(
        [
            'controller' => Controller::class,
            'name' => 'places_of_business',
            'uriParameter' => 'place_of_business',
            'prefix' => 'organization',
        ]
    )
);

Route::get('/places_of_business/staff/{place_of_business}', [Controller::class, 'getStaff']);
