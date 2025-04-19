<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{
    DepartmentController,
    HospitalController,
    CareCenterController,
    Department_HospitalController,
    CareCenter_DepartmentController,
    ChainPharmaciesController,
    PharmacyController,
    ChainLaboratoriesController,
    LaboratoryController,
    DoctorController,
    SpecializationController,
    DoctorSpecializationController,
    ClinicController,
    ClinicImageController,
    ClinicDoctorController,
    TipController,
    DeliveryServiceController,
    StatisticsController,
    OfferGroupController,
    UserController,
    ContactController,
    InsuranceCompanyController,
    InusranceCompanyPharmacyController,
    InusranceCompanyLaboratoryController
};

Route::apiResource('Departments', DepartmentController::class);
Route::apiResource('Hospitals', HospitalController::class);
Route::apiResource('CareCenters', CareCenterController::class);

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
Route::delete('Doctors/{doctorId}/Specializations/{specializationId}', [
    DoctorSpecializationController::class,
    'destroy'
]);

Route::apiResource('Clinics', ClinicController::class);
Route::apiResource('Clinic_Images', ClinicImageController::class);
Route::apiResource('Tips', TipController::class);
Route::apiResource('Delivery_Services', DeliveryServiceController::class);
Route::apiResource('insurance-companies', InsuranceCompanyController::class);
Route::apiResource('insurance-companies-pharmacy', InusranceCompanyPharmacyController::class);
Route::apiResource('insurance-companies-laboratory', InusranceCompanyLaboratoryController::class);

Route::middleware('auth:admins')->group(function () {
    Route::post('/doctor/{doctorId}/clinic/{clinicId}', [ClinicDoctorController::class, 'store']);
    Route::delete('/doctor/{doctorId}/clinic/{clinicId}', [ClinicDoctorController::class, 'destroy']);
});
Route::apiResource('contact-us', ContactController::class);
Route::post('contact-us/{countactId}/reply', [ContactController::class, 'reply']);
Route::get('/statistics', [StatisticsController::class, 'getStatistics']);
Route::apiResource('Offer_Groups', OfferGroupController::class);
Route::apiResource('/allusers', UserController::class);