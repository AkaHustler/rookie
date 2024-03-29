<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/user', [UserController::class, 'index']);

Route::get('/tree', [UserController::class, 'tree']);

Route::get('/es', [UserController::class, 'elasticsearch']);

Route::get('/redis', [UserController::class, 'getAliAttribute']);

Route::get('/demo', [UserController::class, 'demo']);
