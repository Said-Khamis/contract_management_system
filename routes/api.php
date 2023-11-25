<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get("testing", [\App\Http\Controllers\HomeController::class,"signedAndNotSigned"])
    ->name("testing");

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::resource('categories', App\Http\Controllers\API\CategoryAPIController::class);

Route::resource('countries', App\Http\Controllers\API\CountryAPIController::class);

Route::resource('regions', App\Http\Controllers\API\RegionAPIController::class);

Route::resource('states', App\Http\Controllers\API\StateAPIController::class);

Route::resource('cities', App\Http\Controllers\API\CityAPIController::class);

Route::resource('districts', App\Http\Controllers\API\DistrictAPIController::class);

Route::resource('wards', App\Http\Controllers\API\WardAPIController::class);

Route::resource('sectors', App\Http\Controllers\API\ContractSectorAPIController::class);

Route::resource('locations', App\Http\Controllers\API\LocationAPIController::class);

Route::resource('departments', App\Http\Controllers\API\DepartmentAPIController::class);

Route::resource('designations', App\Http\Controllers\API\DesignationAPIController::class);

Route::resource('employee_departments', App\Http\Controllers\API\EmployeeDepartmentAPIController::class);

Route::resource('employees', App\Http\Controllers\API\EmployeeAPIController::class);

Route::resource('contract_parties', App\Http\Controllers\API\ContractPartyAPIController::class);

Route::resource('contractss', App\Http\Controllers\API\ContractAPIController::class);

Route::resource('contract_objectives', App\Http\Controllers\API\ContractObjectiveAPIController::class);

Route::resource('contract_operation_areas', App\Http\Controllers\API\ContractOperationAreaAPIController::class);

Route::resource('contract_responsibilities', App\Http\Controllers\API\ContractResponsibilityAPIController::class);

Route::resource('contract_responsibility_statuses', App\Http\Controllers\API\ContractResponsibilityStatusAPIController::class);

Route::resource('attachments', App\Http\Controllers\API\AttachmentAPIController::class);

Route::resource('contract_notices', App\Http\Controllers\API\ContractNoticeAPIController::class);

//Route::resource('institutions', App\Http\Controllers\API\InstitutionAPIController::class);
//
//
//Route::resource('contract_managers', App\Http\Controllers\API\ContractManagerAPIController::class);

Route::resource('action_plans', App\Http\Controllers\API\ActionPlanAPIController::class);

Route::resource('implementation_statuses', App\Http\Controllers\API\ImplementationStatusAPIController::class);
Route::resource('general_statuses', App\Http\Controllers\API\GeneralStatusAPIController::class);
