<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Classifiers\Nomenclature\Materials\MaterialController as Controller;

Route::prefix('materials')->group(static function () {
    require_once __DIR__ . '/types_of_materials.php';
});

Route::resource('materials', Controller::class)
    ->except(['show', 'edit', 'create']);
Route::controller(Controller::class)->group(static function () {
    Route::post('/materials/{material}/restore', 'restore')
        ->name('materials.restore')
        ->withTrashed();
});