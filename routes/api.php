<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "Api" middleware group. Enjoy building your API!
|
*/



//Route::middleware('auth:Api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/test', [UserController::class, 'index']);

Route::namespace('Api')->prefix('v1')->group(function () {
    Route::get('/users',[UserController::class, 'index'])->name('users.index');
});
