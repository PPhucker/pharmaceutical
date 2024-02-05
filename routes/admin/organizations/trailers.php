<?php

use App\Http\Controllers\Admin\Organization\Transport\TrailerController as Controller;

Route::delete('/trailers/{trailer}', [Controller::class, 'destroy'])
    ->name('organization.trailers.destroy');

Route::post('/trailers', [Controller::class, 'store'])
    ->name('organization.trailers.store');

Route::patch('/trailers/{trailer}', [Controller::class, 'update'])
    ->name('organization.trailers.update');

Route::post('/trailers/{trailer}/restore', [Controller::class, 'restore'])
    ->name('organization.trailers.restore')
    ->withTrashed();
