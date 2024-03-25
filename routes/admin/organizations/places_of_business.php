<?php

use App\Helpers\Route\RouteHelper;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Organization\PlaceOfBusinessController as Controller;

(new RouteHelper(
    collect(
        [
            'controller' => Controller::class,
            'name' => 'places_of_business',
            'uriParameter' => 'place_of_business',
            'prefix' => 'organization',
        ]
    )
))->mapWritableRoutes();

Route::get('/places_of_business/staff/{place_of_business}', [Controller::class, 'getStaff']);
