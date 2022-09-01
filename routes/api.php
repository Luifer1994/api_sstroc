<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\ArlController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\EducationLevelController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EvaluateMatrixController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FindingController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\HousingTypeController;
use App\Http\Controllers\IdentificationHazardAndRiskController;
use App\Http\Controllers\KindredController;
use App\Http\Controllers\MaritalStatuController;
use App\Http\Controllers\MatrixRiskController;
use App\Http\Controllers\PensionFundController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RiskController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\SocialSecurityController;
use App\Http\Controllers\TypeContractController;
use App\Http\Controllers\TypeDocumentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\TracingController;
use App\Http\Controllers\RiskTypeController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProcesseController;

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
        Route::get('user-list', 'index')/* ->middleware('admin_aux') */;
        Route::get('validate-sesion', 'validateSesion');
    });
    //Employees
    Route::controller(EmployeeController::class)->group(function () {
        Route::post('employee-register', 'store');
        Route::post('employee-register-perfil', 'store_perfil');
        Route::get('employee-list', 'index');
        Route::get('employee-detail/{id}', 'show');
        Route::get('employee-detail-perfil/{id}', 'show_perfil');
        Route::delete('employee-delete/{id}', 'destroy');
        Route::put('employee-update/{id}', 'update');
    });
    //Findings
    Route::controller(FindingController::class)->group(function () {
        Route::post('finding-register', 'store');
        Route::get('finding-list', 'index');
        Route::get('finding-detail/{id}', 'show');
        Route::put('finding-closed/{id}', 'closed');
        Route::get('count-open-and-closed', 'closedVsOPen');
    });
    //tracing
    Route::controller(TracingController::class)->group(function () {
        Route::post('tracing-register', 'store');
    });
    //Document type
    Route::controller(TypeDocumentController::class)->group(function () {
        Route::get('document-type-list', 'index');
    });
    //Document type
    Route::controller(RolController::class)->group(function () {
        Route::get('rol-list', 'index');
    });
    //Document type
    Route::controller(GenderController::class)->group(function () {
        Route::get('gender-list', 'index');
    });
    //City
    Route::controller(CityController::class)->group(function () {
        Route::get('city-list', 'index');
        Route::post('city-register', 'store');
        Route::put('city-update/{id}', 'update');
        Route::get('city-detail/{id}', 'show');
    });
    //Countries
    Route::controller(CountryController::class)->group(function () {
        Route::get('country-list', 'index');
        Route::post('country-register', 'store');
        Route::put('country-update/{id}', 'update');
        Route::get('country-detail/{id}', 'show');
    });
    //House types
    Route::controller(HousingTypeController::class)->group(function () {
        Route::get('housing-types-list', 'index');
        Route::get('housing-types-list-paginate', 'listPaginate');
        Route::get('housing-types-detail/{id}', 'show');
        Route::post('housing-types-register', 'store');
        Route::put('housing-types-update/{id}', 'update');
        Route::delete('housing-types-delete/{id}', 'destroy');
    });
    //Kindre
    Route::controller(KindredController::class)->group(function () {
        Route::get('kindred-list', 'index');
    });
    //Educatio level
    Route::controller(EducationLevelController::class)->group(function () {
        Route::get('education-level-list', 'index');
        Route::get('education-level-list-paginated', 'listPaginate');
        Route::get('education-level-detail/{id}', 'show');
        Route::post('education-level-register', 'store');
        Route::put('education-level-update/{id}', 'update');
        Route::delete('education-level-delete/{id}', 'destroy');
    });
    //position
    Route::controller(PositionController::class)->group(function () {
        Route::get('position-list', 'index');
        Route::get('process-by-position/{position_id}', 'listProcessByPosition');
    });
    //type contract
    Route::controller(TypeContractController::class)->group(function () {
        Route::get('type-contract-list', 'index');
    });
    //Social security
    Route::controller(SocialSecurityController::class)->group(function () {
        Route::get('social-security-list', 'index');
    });
    //Marital status
    Route::controller(MaritalStatuController::class)->group(function () {
        Route::get('marital-status-list', 'index');
    });
    //pension fund
    Route::controller(PensionFundController::class)->group(function () {
        Route::get('pension-fund-list', 'index');
        Route::get('pension-fund-list-paginated', 'listPaginate');
        Route::get('pension-fund-detail/{id}', 'show');
        Route::post('pension-fund-register', 'store');
        Route::put('pension-fund-update/{id}', 'update');
        Route::delete('pension-fund-delete/{id}', 'destroy');
    });
    //pension fund
    Route::controller(ArlController::class)->group(function () {
        Route::get('arl-list', 'index');
        Route::get('arl-list-paginate', 'listPaginate');
        Route::post('arl-register', 'store');
        Route::put('arl-update/{id}', 'update');
        Route::delete('arl-delete/{id}', 'destroy');
        Route::get('arl-detail/{id}', 'show');
    });
    //survey
    Route::controller(SurveyController::class)->group(function () {
        Route::get('survey-detail/{id}', 'show');
        Route::post('survey/{id}/add-responses', 'save_questions_survey');
    });
    //area
    Route::controller(AreaController::class)->group(function () {
        Route::get('areas-list', 'index');
        Route::get('top-finding-for-area', 'topFindingForArea');
        Route::get('areas-list-paginate', 'listPaginate');
        Route::post('area-register', 'store');
        Route::put('area-update/{id}', 'update');
        Route::delete('area-delete/{id}', 'destroy');
        Route::get('area-detail/{id}', 'show');
    });
    //Identification risk
    Route::controller(IdentificationHazardAndRiskController::class)->group(function () {
        Route::get('top-risk-last-six-months', 'topRisk');
    });
    //Matrix risk
    Route::controller(MatrixRiskController::class)->group(function () {
        Route::post('matrix-risk-create', 'store');
        Route::get('matrix-ris-list', 'index');
        Route::get('matrix-ris-detail/{id}', 'show');
    });
    //Matrix risk
    Route::controller(EvaluateMatrixController::class)->group(function () {
        Route::post('evaluate-matrix-create', 'store');
        Route::get('evaluate-matrix-detail/{id}', 'show');
    });
    //Risk
    Route::controller(RiskController::class)->group(function () {
        Route::get('risk-list', 'index');
    });
    //Tasks
    Route::controller(TaskController::class)->group(function () {
        Route::get('task-list', 'index');
    });
    //Process
    Route::controller(ProcessController::class)->group(function () {
        Route::get('process-list', 'index');
    });
    //Events
    Route::controller(EventController::class)->group(function () {
        Route::post('event-register', 'store');
        Route::get('event-list-user', 'eventUser');
        Route::get('event/{id}', 'findEvent');
        Route::put('event-update/{id}', 'update');
        Route::delete('event-delete/{id}', 'delete');
    });

    //Documents
    Route::controller(DocumentController::class)->group(function () {
        Route::post('document-register', 'store');
        Route::get('document-list', 'index');
        Route::get('document-detail/{id}', 'show');
        Route::put('document-update/{id}', 'update');
    });
});

//Usuarios no protegidas
Route::controller(UserController::class)->group(function () {
    Route::post('user-login', 'login');
});

Route::get('risk-types-list-and-risk', [RiskTypeController::class, 'index']);
Route::post('store-identification-risk', [IdentificationHazardAndRiskController::class, 'store']);

Route::get('employee-by-document', [EmployeeController::class, 'findDocument']);
