<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    Controller::setlocale($locale);
    return redirect()->back();
});


Route::get('/', [Controller::class, 'getServers'])->name('welcome');

Route::get('c6dZ7nmfxmNwXpq8CC7DU8mf', [AuthController::class, 'index'])->name('login');
Route::post('fAvvzzNWkUcPuzY2RG6hKQY5', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('tg4f8ZJq3BWzPNwhfcwLXaQx', [AuthController::class, 'registration'])->name('register');
Route::post('5qTbCuGUj3y8w8t4ctuS9PYT', [AuthController::class, 'postRegistration'])->name('register.post');

Route::get('S3bvKsNbeEcdYZ7XNqp5A3Lf', [Controller::class, 'getServers'])->name('servers');

Route::get('myUnKHdjFHypUqthVZZmE', [VoteController::class, 'getVotePage'])->name('votePage');
Route::get('6f76f699g78hh09t57f7sdfd', function () {
    return view('element.disclaimer');
})->name('disclaimerPage');



Route::post('QU5XxkFzpR7pf97xjLRL7', [VoteController::class, 'vote'])->name('vote');

Route::middleware(['auth'])->group(function () {
    Route::get('j62gws2GeDnLHxkRy5DudPjP', [AuthController::class, 'dashboard'])->name('dashboard');

    Route::get('cbs4rbDnS8qKVdYWYmqBAWNz', [AuthController::class, 'logout'])->name('logout');
    Route::post('yPeudqM9HKmGds2NzFYLRCLw', [ServerController::class, 'createServer'])->name('create.server');
    Route::post('7568f57f8d8g9o978hg8h90890h89h', [ServerController::class, 'updateServer'])->name('update.server');

    Route::get('89h87h900879g07g86986g79f0807g', [AdminController::class, 'getAdminPage'])->middleware('admin')->name('getAdminPage');

    Route::post('76g89g97689gf6758975f69f7f87', [AdminController::class, 'ServerStatus'])->middleware('admin')->name('okayServer');
    Route::post('6f7gf96578f9658712332f7986998h', [AdminController::class, 'ServerStatus'])->middleware('admin')->name('blockServer');

    Route::get('f67f76ff8g98h068g8guigiz9', function () {
        return view('element.how-to');
    })->name('howToPage');
});

Route::post('test', [VoteController::class, 'checkVote'])->name('checkVote');

