<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified']);

Auth::routes();

Route::get('/email/verify', static function () {
    return view('auth.verify');
})
    ->middleware('auth')
    ->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', static function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', static function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()
        ->with('success', __('auth.verify.link'));
})
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

Route::middleware(['auth', 'verified'])->group(
    static function () {
        Route::get('/home', [HomeController::class, 'index'])
            ->name('home');
        require_once __DIR__ . '/admin/web.php';
        require_once __DIR__ . '/classifiers/web.php';
        require_once __DIR__ . '/contractors/web.php';
    }
);
