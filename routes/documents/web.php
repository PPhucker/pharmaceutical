<?php

Route::prefix('documents')->group(static function () {
    require_once __DIR__ . '/invoices_for_payment.php';
});
