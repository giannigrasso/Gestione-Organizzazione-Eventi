<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return redirect('/events');
});

Route::resource('/events', EventController::class)->middleware('auth');

Route::resource('/hotels', HotelController::class)->middleware('auth');

Route::resource('/users', UserController::class)->middleware('auth');
Route::resource('/groups', GroupController::class)->middleware('auth');
Route::resource('/companies', CompanyController::class)->middleware('auth');

Route::resource('/rooms', RoomController::class)->middleware('auth');

Route::get(
    '/groups/create/{event}',
    [GroupController::class, 'create']
)->name('createGroup');