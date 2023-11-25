<?php

use App\Http\Controllers\Approval\ApprovalController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/*Route::get("error", function (){
    return view("errors.minimal");
});*/

Auth::routes();
/* Password Reset */
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
Route::post('/password/store', [ForgotPasswordController::class, 'passwordStore'])->name('password.store');
Route::get('/password/reset/{token}/{email}', [ResetPasswordController::class,'showResetForm'])->name('password.reset');


Route::get('/password/create/{token}/{email}', [ResetPasswordController::class,'createPasswordForm'])->name('password.create');


// Email Verification Notice
Route::get('email/verify', function () {
    return view('auth.verify')->with('email', auth()->user()->email);
})->middleware('auth')->name('verification.notice');

// Email Verification Handler
Route::get('email/verify/{id}/{hash}', 'App\Http\Controllers\Auth\VerificationController@verify')
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

// Resending The Verification Email
Route::post('email/verification-notification', function (\Illuminate\Http\Request $request) {
    $request->user()->sendEmailVerificationNotification();
    $request->session()->put('resent', true);

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Mail Template Design Preview
Route::get('email/preview', function () {
    $user = auth()->user();

    return (new \Illuminate\Notifications\Messages\MailMessage)->view(
        'vendor.notifications.email-verify', ['user' => $user]
    );
})->middleware('auth')->name('email.preview');

Route::middleware(['auth', 'verified'])->group(function() {
    require('livewire.php');

    //user profile
    Route::get('/profile',[\App\Http\Controllers\UserManagementController::class,'profile'])
        ->name('user.profile');
    Route::post('/profile/store',[\App\Http\Controllers\UserManagementController::class,'profileStore'])
        ->name('user.profile.store');
    Route::post('/user/profile/password/update',[\App\Http\Controllers\UserManagementController::class,
        'userProfilePasswordUpdate'])->name('user.password.update');


    Route::get('/countingSectorsContract', [App\Http\Controllers\HomeController::class, 'sectorsContracts'])
        ->name('countingSectorsContract');

    Route::get('/countingDraftSigned', [App\Http\Controllers\HomeController::class, 'signedAndNotSigned'])
        ->name('countingDraftSigned');

    Route::get('/internalAndExternal', [App\Http\Controllers\HomeController::class, 'internalAndExternal'])
        ->name('internalAndExternal');

    Route::get('/implementedAndNot', [App\Http\Controllers\HomeController::class, 'implementedAndNot'])
        ->name('implementedAndNot');

    Route::get('/contractPerformancesGraph', [App\Http\Controllers\HomeController::class, 'contractPerformancesGraph'])
        ->name('contractPerformancesGraph');

    Route::get('/countingContracts', [App\Http\Controllers\HomeController::class, 'contractCounting']);
    Route::get('/countingContracts', [App\Http\Controllers\HomeController::class, 'contractCounting'])
        ->name('contractCounting');

    Route::get('/contractPerformances', [App\Http\Controllers\HomeController::class,
        'contractPerformances'])
        ->name('contractPerformances');

    Route::post('check/institution', [App\Http\Controllers\InstitutionController::class,
        'checkInstitution']);

    Route::post('check/abbreviation', [App\Http\Controllers\InstitutionController::class,
        'checkAbbreviation']);

    Route::get('password/new', [App\Http\Controllers\Auth\NewPasswordController::class,
        'showNewPasswordForm'])->name('password.new');

    Route::post('check/sector', [App\Http\Controllers\SectorController::class,
        'checkSector']);

    Route::post('check/subTypeName', [App\Http\Controllers\ContractSubtypeController::class,
        'checkSubTypeName']);

    Route::post('check/subType', [App\Http\Controllers\ContractSubtypeController::class,
        'checkSubType']);

    Route::get('password/new', [App\Http\Controllers\Auth\NewPasswordController::class,'showNewPasswordForm'])
        ->name('password.new');

    Route::post('password/new', [App\Http\Controllers\Auth\NewPasswordController::class,'new'])
        ->name('password.create');

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('sectors', App\Http\Controllers\SectorController::class);
    Route::resource('contract_subtypes', App\Http\Controllers\ContractSubtypeController::class);
    Route::get('contract_subtype/{id}/delete', [App\Http\Controllers\ContractSubtypeController::class,'destroy'])->name('contract_subtypes.delete');


    Route::resource('locations', App\Http\Controllers\LocationController::class);
    Route::get('/get-locations/{id}', [App\Http\Controllers\LocationController::class,'getLocations']);
    Route::get('/get-contract_subtypes/{id}', [App\Http\Controllers\ContractController::class,'getContractSubTypes']);

    Route::resource('employeeDepartments', App\Http\Controllers\EmployeeDepartmentController::class);

    Route::resource('contractParties', App\Http\Controllers\ContractPartyController::class);

    Route::resource('contracts', App\Http\Controllers\ContractController::class);
    Route::get('contracts/delete/{contractId}', [App\Http\Controllers\ContractController::class,'destroy'])
        ->name('contracts.delete');
    Route::get('draft/contracts', [App\Http\Controllers\ContractController::class,'draftContracts'])->name('draft.contracts');
    Route::get('draft/contract/show/{contractId}', [App\Http\Controllers\ContractController::class,'draftContractShow'])->name('draft.contract.show');

    Route::resource('contractObjectives', App\Http\Controllers\ContractObjectiveController::class);

    Route::resource('contractOperationAreas', App\Http\Controllers\ContractOperationAreaController::class);
    Route::resource('contractDeliveries', App\Http\Controllers\ContractDeliveryController::class);

    Route::resource('contractResponsibilities', App\Http\Controllers\ContractResponsibilityController::class);
    Route::get('contractSendTo/{id}', [App\Http\Controllers\ContractController::class,'contractSendTo']);
    Route::post('submitSendContractTo', [App\Http\Controllers\ContractController::class,'submitSendContractTo'])->name('submitSendContractTo');

    Route::resource('contractResponsibilityStatuses', App\Http\Controllers\ContractResponsibilityStatusController::class);

    Route::resource('attachments', App\Http\Controllers\AttachmentController::class);

    Route::resource('contractNotices', App\Http\Controllers\ContractNoticeController::class);
    Route::delete('contractNotices/{contractNoticeId}/delete', [App\Http\Controllers\ContractNoticeController::class,'destroy'])->name('contractNotices.delete');

    Route::resource('contractActionPlans', App\Http\Controllers\ActionPlanController::class);
    Route::get('/get-publication-url/{publicationId}', [App\Http\Controllers\ActionPlanController::class,'getPublicationUrl']);

    //Route::resource('contractManagers', App\Http\Controllers\ContractManagerController::class);

    //user roles and permissions

    Route::get('rolePermissions/{name}', [App\Http\Controllers\UserManagementController::class, 'rolePermission'
    ])->name('user.role');

    Route::get('permission/show/{id}', [App\Http\Controllers\UserManagementController::class, 'showPermission'
    ])->name('permission.show');

    Route::get('permission/edit/{id}', [App\Http\Controllers\UserManagementController::class, 'editPermission'
    ])->name('permission.edit');

    Route::get('role/add', [App\Http\Controllers\UserManagementController::class, 'createRole'
    ])->name('role.add');

    Route::get('role/{role}/edit', [App\Http\Controllers\UserManagementController::class, 'editRole'
    ])->name('role.edit');

    Route::patch('role/{role}', [App\Http\Controllers\UserManagementController::class, 'roleUpdate'
    ])->name('role.update');

    Route::get('role/{role}', [App\Http\Controllers\UserManagementController::class, 'showRole'
    ])->name('role.show');

    Route::post('role/create', [
        'uses' => 'App\Http\Controllers\UserManagementController@roleCreate',
        'as' => 'role.create'
    ]);

    Route::post('permission/create', [
        'uses' => 'App\Http\Controllers\UserManagementController@permissionCreate',
        'as' => 'permission.create'
    ]);

    Route::get('permission/{name}', [
        'uses' => 'App\Http\Controllers\UserManagementController@rolePermission',
        'as' => 'role'
    ]);

    Route::get('user/grant/permission/{id}', [
        'uses' => 'App\Http\Controllers\UserManagementController@grantAllPermissionToUser',
        'as' => 'grant.permission'
    ]);

    Route::get('user/revoke/permission/{id}', [
        'uses' => 'App\Http\Controllers\UserManagementController@revokeAllPermissionToUser',
        'as' => 'revoke.permission'
    ]);

    Route::post('user/assign/roles', [
        'uses' => 'App\Http\Controllers\UserManagementController@assignRolesToUser',
        'as' => 'roles.assign'
    ]);

    Route::post('/role/assign/permissions', [
        'uses' => 'App\Http\Controllers\UserManagementController@assignPermissionToRole',
        'as' => 'roles.assign'
    ]);

    Route::post('user/assign/permissions', [
        'uses' => 'App\Http\Controllers\UserManagementController@assignPermissionToUser',
        'as' => 'permissions.assign'
    ]);

    Route::get('user/{user}/status', [App\Http\Controllers\UserManagementController::class, 'changeUserStatus'
    ])->name('user.status');

    Route::resource('user', App\Http\Controllers\UserManagementController::class);

    /**
     * Approval section
     */
    Route::prefix('approval')->group(function () {

        Route::get('approvalGroup/selector', [
            App\Http\Controllers\Approval\ApprovalGroupController::class, 'selector'
        ])->name('approvalGroup.selector');

        Route::get('approvals/filter/{filterId}', [ApprovalController::class, 'filter'])->name('approvals.filter');
        Route::post('approvals/approve/{id}', [ApprovalController::class, 'approve',])->name('approvals.approve');


        Route::resource('approvals', ApprovalController::class);

        Route::resource('approvalWorkFlows', App\Http\Controllers\Approval\ApprovalWorkFlowController::class);

        Route::resource('approvalGroups', App\Http\Controllers\Approval\ApprovalGroupController::class);

        Route::resource('approvalHistories', App\Http\Controllers\Approval\ApprovalHistoryController::class);

    });

    Route::resource('contractTerminations', App\Http\Controllers\ContractTerminationController::class);

    Route::get('attachment/{id}/preview', function ($id) {
        $file = \App\Models\Attachment::find(decode($id));
        return response()->file(public_path($file->url));
    })->name('attachment.preview');

    Route::get('attachment/{id}', [AttachmentController::class, 'destroy']);

    Route::post('departments/update',
        [App\Http\Controllers\DepartmentController::class,"update"]);

    Route::post('designations/update',
        [App\Http\Controllers\DesignationController::class,"update"]);

    Route::post('institution/update',
        [App\Http\Controllers\InstitutionController::class,"update"])
        ->name("institution.update");

    /*Route::delete('departments/{id}/delete',[
        App\Http\Controllers\DepartmentController::class,"destroy"
    ]);*/

    Route::get('departments/{id}/delete',[
        App\Http\Controllers\DepartmentController::class,"destroy"
    ]);

    Route::get('designations/{id}/delete',[
        App\Http\Controllers\DesignationController::class,"destroy"
    ]);

    Route::get('institution/{id}/delete',[
        App\Http\Controllers\InstitutionController::class,"destroy"
    ]);

    Route::resource('internal-procedures', App\Http\Controllers\InternalProcedureController::class);
    Route::get('internal-procedures/create-for-contract/{contract_id}', 'App\Http\Controllers\InternalProcedureController@createForContract')->name('internal-procedures.create-for-contract');
    Route::post('internal-procedures/create-for-contract/{contract_id}', 'App\Http\Controllers\InternalProcedureController@createForContract')->name('internal-procedures.create-for-contract');

    //settings routes
    Route::prefix('settings')->group(function () {
        Route::resource('institutions', App\Http\Controllers\InstitutionController::class);
        Route::resource('categories', App\Http\Controllers\CategoryController::class);
        Route::resource('departments', App\Http\Controllers\DepartmentController::class);
        Route::resource('designations', App\Http\Controllers\DesignationController::class);
        Route::resource('employees', App\Http\Controllers\EmployeeController::class);
//        //user role and permission
//        Route::resource('user', App\Http\Controllers\UserManagementController::class);
//        Route::get('user/role/{name}', [App\Http\Controllers\UserManagementController::class, 'rolePermission'
//        ])->name('user.role');

        //locations route
        Route::prefix('locations')->group(function () {
            Route::resource('countries', App\Http\Controllers\CountryController::class);
            Route::get('countries/delete/{countryId}', [App\Http\Controllers\CountryController::class,'destroy'])->name('countries.delete');

            Route::resource('states', App\Http\Controllers\StateController::class);
            Route::get('states/delete/{stateId}', [App\Http\Controllers\StateController::class,'destroy'])
                ->name('states.delete');

            Route::resource('regions', App\Http\Controllers\RegionController::class);
            Route::get('regions/delete/{regionId}', [App\Http\Controllers\RegionController::class,'destroy'])->name('regions.delete');

            Route::resource('districts', App\Http\Controllers\DistrictController::class);
            Route::get('districts/delete/{districtId}', [App\Http\Controllers\DistrictController::class,'destroy'])->name('districts.delete');

            Route::resource('wards', App\Http\Controllers\WardController::class);
            Route::get('wards/delete/{wardId}', [App\Http\Controllers\WardController::class,'destroy'])->name('wards.delete');

            Route::resource('cities', App\Http\Controllers\CityController::class);
            Route::get('cities/delete/{cityId}', [App\Http\Controllers\CityController::class,'destroy'])->name('cities.delete');
        });

    });

    Route::delete("implementationStatuses/destroy", [
        App\Http\Controllers\ImplementationStatusController::class,"destroy"
    ])->name("destroy.status");

    Route::resource('implementationStatuses',
        App\Http\Controllers\ImplementationStatusController::class);

    Route::resource('generalStatuses',
        App\Http\Controllers\GeneralStatusController::class);



// Get Category Add Fields
//    Route::get('category/fields', function () {
//        return View('categories.fields');
//    });

// Get Category Edit Fields
    //Route::get('categories/edit/fields/{id}', [App\Http\Controllers\CategoryController::class, 'editFields'])->name('categories.edit.fields');

// Get Category Show Fields
    //Route::get('categories/show/fields/{id}', [App\Http\Controllers\CategoryController::class, 'showFields'])->name('categories.show.fields');

// Update Category
//    Route::post('category/update/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
});
