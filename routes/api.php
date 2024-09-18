<?php

use App\Http\Controllers\VoteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware(['blockIP'])->group(function () {
    Route::post('QpeoTymspwObUz5dlG1D44', [VoteController::class, 'checkVote'])/*->middleware('throttle:60,1')*/->name('checkVote');
});

Route::any('{all}', function () {
    return redirect()->away('https://www.metin2toplist.eu');
})->where('all', '^(?!api).*$');
