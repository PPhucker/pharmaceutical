<?php

use App\Http\Controllers\Admin\Organization\OrganizationController as Controller;

Route::resource('organizations', Controller::class);

Route::controller(Controller::class)->group(static function () {
    Route::post('/organizations/{organization}/restore', 'restore')
        ->name('organizations.restore')
        ->withTrashed();
});
