<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\HelloWorldController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/email', [MailController::class, 'show']);
Route::get('/email/{id}', [MailController::class, 'showById']);
Route::post('/email', [MailController::class, 'store']);
Route::put('/email/{id}', [MailController::class, 'update']);
Route::delete('/email/{id}', [MailController::class, 'delete']);

Route::post('/hello', [HelloWorldController::class, 'send']);