<?php


use App\Http\Controllers\API\{CareCenterController, DepartmentController, HospitalController, Department_HospitalController, CareCenter_DepartmentController, ChainPharmaciesController, PharmacyController, ChainLaboratoriesController, LaboratoryController, DoctorController, SpecializationController, DoctorSpecializationController, DoctorOfferController, DoctorOfferImageController};
Route::apiResource('Departments', DepartmentController::class);
Route::apiResource('Hospitals', HospitalController::class); //  Route Hospitals
Route::apiResource('CareCenters', CareCenterController::class); //  Route CareCenters
Route::prefix('Department_Hospital')->controller(Department_HospitalController::class)->group(function () {
    Route::post('/', 'store');
    Route::put('/{department_id}/{hospital_id}', 'update');
});
Route::prefix('CareCenter_Department')->controller(CareCenter_DepartmentController::class)->group(function () {
    Route::post('/', 'store');
    Route::put('/{department_id}/{care_center_id}', 'update');
});
Route::apiResource('Chain_Pharmacies', ChainPharmaciesController::class);
Route::apiResource('Pharmacies', PharmacyController::class);
Route::apiResource('Chain_Laboratories', ChainLaboratoriesController::class);
Route::apiResource('Laboratories', LaboratoryController::class);
Route::apiResource('Doctors', DoctorController::class);
Route::apiResource('Specializations', SpecializationController::class);
Route::apiResource('Doctor_Specialization', DoctorSpecializationController::class);
Route::delete('Doctors/{doctorId}/Specializations/{specializationId}', [DoctorSpecializationController::class, 'destroy']);
Route::apiResource('Doctor_Offers', DoctorOfferController::class);
Route::apiResource('Doctor_Offer_Images', DoctorOfferImageController::class);
