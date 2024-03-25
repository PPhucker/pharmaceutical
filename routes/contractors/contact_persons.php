<?php

use App\Helpers\Route\RouteHelper;
use App\Http\Controllers\Contractor\ContactPersonController as Controller;

(new RouteHelper(
    collect(
        [
            'controller' => Controller::class,
            'name' => 'contact_persons',
            'uriParameter' => 'contact_person',
        ]
    )
))->mapWritableRoutes();
