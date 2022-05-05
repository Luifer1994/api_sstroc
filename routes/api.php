<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

//Rutas protegidas
Route::group(['middleware' => 'auth:sanctum'], function () {
    //User
    Route::controller(UserController::class)->group(function () {
        Route::get('user-logout', 'logout');
        Route::post('user-register', 'store');
        Route::get('user-list','index');
    });
    //Employees
    Route::controller(EmployeeController::class)->group(function () {
        Route::post('employee-register', 'store');
        Route::get('employee-list','index');
    });
});

//Usuarios no protegidas
Route::controller(UserController::class)->group(function () {
    Route::post('user-login', 'login');
});
