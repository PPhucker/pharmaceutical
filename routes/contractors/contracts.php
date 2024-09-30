<?php

use App\Helpers\Route\RouteHelper;
use App\Http\Controllers\Contractor\ContractController as Controller;

(new RouteHelper(
    collect(
        [
            'controller' => Controller::class,
            'name' => 'contracts',
            'uriParameter' => 'contract',
        ]
    )
))->mapWritableRoutes();
