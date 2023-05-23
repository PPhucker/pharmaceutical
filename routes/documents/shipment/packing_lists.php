<?php

use App\Http\Controllers\Documents\Shipment\PackingLists\PackingListController as Controller;

Route::resource('packing_lists', Controller::class);

Route::controller(Controller::class)->group(static function () {
    Route::post('/packing_lists/{packing_list}/restore', 'restore')
        ->name('packing_lists.restore')
        ->withTrashed();
    Route::post('/packing_lists/redirect', 'redirect')
        ->name('packing_lists.redirect');
    Route::post('/approval/{packing_list}/send_email_to_marketing', 'sendEmailApprovalToMarketing')
        ->name('approval.send_email_to_marketing');
    Route::post(
        '/approval/{packing_list}/send_email_to_digital_comunication',
        'sendEmailApprovalToDigitalCommunication'
    )
        ->name('approval.send_email_to_digital_comunication');
    Route::get('/approval', 'approval')
        ->name('shipment.approval');
    Route::patch('/packing_lists/approve/{packing_list}', 'approve')
        ->name('packing_lists.approve');
});
