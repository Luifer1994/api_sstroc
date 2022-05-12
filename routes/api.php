<?php

use App\Http\Controllers\ArlController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EducationLevelController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\HousingTypeController;
use App\Http\Controllers\KindredController;
use App\Http\Controllers\MaritalStatuController;
use App\Http\Controllers\PensionFundController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\SocialSecurityController;
use App\Http\Controllers\TypeContractController;
use App\Http\Controllers\TypeDocumentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SurveyController;
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
        Route::get('validate-sesion', 'validateSesion');
    });
    //Employees
    Route::controller(EmployeeController::class)->group(function () {
        Route::post('employee-register', 'store');
        Route::post('employee-register-perfil', 'store_perfil');
        Route::get('employee-list','index');
        Route::get('employee-detail/{id}','show');
    });
    //Document type
    Route::controller(TypeDocumentController::class)->group(function () {
        Route::get('document-type-list','index');
    });
    //Document type
    Route::controller(GenderController::class)->group(function () {
        Route::get('gender-list','index');
    });
    //City
    Route::controller(CityController::class)->group(function () {
        Route::get('city-list','index');
        Route::post('city-register','store');
        Route::put('city-update/{id}','update');
        Route::get('city-detail/{id}','show');
    });
    //Countries
    Route::controller(CountryController::class)->group(function () {
        Route::get('country-list','index');
        Route::post('country-register','store');
        Route::put('country-update/{id}','update');
        Route::get('country-detail/{id}','show');
    });
    //House types
    Route::controller(HousingTypeController::class)->group(function () {
        Route::get('housing-types-list','index');
    });
    //Kindre
    Route::controller(KindredController::class)->group(function () {
        Route::get('kindred-list','index');
    });
    //Educatio level
    Route::controller(EducationLevelController::class)->group(function () {
        Route::get('education-level-list','index');
    });
    //position
    Route::controller(PositionController::class)->group(function () {
        Route::get('position-list','index');
    });
    //type contract
    Route::controller(TypeContractController::class)->group(function () {
        Route::get('type-contract-list','index');
    });
    //Social security
    Route::controller(SocialSecurityController::class)->group(function () {
        Route::get('social-security-list','index');
    });
    //Marital status
    Route::controller(MaritalStatuController::class)->group(function () {
        Route::get('marital-status-list','index');
    });
    //pension fund
    Route::controller(PensionFundController::class)->group(function () {
        Route::get('pension-fund-list','index');
    });
    //pension fund
    Route::controller(ArlController::class)->group(function () {
        Route::get('arl-list','index');
    });
    //survey
    Route::controller(SurveyController::class)->group(function () {
        Route::get('survey-detail/{id}','show');
        Route::post('survey/{id}/add-responses','save_questions_survey');
    });
});

//Usuarios no protegidas
Route::controller(UserController::class)->group(function () {
    Route::post('user-login', 'login');
});
