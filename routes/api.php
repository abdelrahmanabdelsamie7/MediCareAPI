<?php
use App\Http\Controllers\{AuthUserController, AuthDoctorController, AuthAdminController};
use App\Http\Controllers\API\{CareCenterController, DepartmentController, HospitalController, Department_HospitalController, CareCenter_DepartmentController, ChainPharmaciesController, PharmacyController, ChainLaboratoriesController, LaboratoryController, DoctorController, SpecializationController, DoctorSpecializationController, DoctorOfferController, DoctorOfferImageController, BlogController, ClinicController, ClinicImageController, ClinicDoctorController, AppointmentController, UserPharmacyController, UserLaboratoryController, UserDoctorController, ReservationController, UserNotification, TipController, DeliveryServiceController};
// Start Admin Authorization الحاجات الادمن بيعملها ..
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
Route::apiResource('Clinics', ClinicController::class);
Route::apiResource('Clinic_Images', ClinicImageController::class);
Route::apiResource('Tips', TipController::class);
Route::apiResource('Delivery_Services', DeliveryServiceController::class);
// Clinic To Doctor Route
Route::middleware('auth:admins')->group(function () {
    Route::post('/doctor/{doctorId}/clinic/{clinicId}', [ClinicDoctorController::class, 'store']);
    Route::delete('/doctor/{doctorId}/clinic/{clinicId}', [ClinicDoctorController::class, 'destroy']);
});
// End Admin Authorization الحاجات الادمن بيعملها ..

// Satrt Doctor Authorization
Route::get('Doctor_Notifications/{doctorId}', [DoctorController::class, 'doctorReservations']);
Route::apiResource('Doctor_Offers', DoctorOfferController::class);
Route::apiResource('Doctor_Offer_Images', DoctorOfferImageController::class);
Route::apiResource('Blogs', BlogController::class);
Route::get('Blogs_Web', [BlogController::class, 'blogsWeb']);
Route::apiResource('Appointments', AppointmentController::class);
// End Doctor Authorization


// Start User Authorization
Route::apiResource('User_Pharmacy', UserPharmacyController::class);
Route::apiResource('User_Laboratory', UserLaboratoryController::class);
Route::apiResource('User_Doctor', UserDoctorController::class);
Route::prefix('reservations')->group(function () {
    Route::get('/available/{doctorId}/{day}', [ReservationController::class, 'getAvailableAppointments']);
    Route::post('/', [ReservationController::class, 'store']);
    Route::put('/{id}/confirm', [ReservationController::class, 'confirmReservation']);
    Route::put('/{id}/cancel', [ReservationController::class, 'cancelReservation']);

});
Route::get('/notifications', function () {
    $user = auth('api')->user();
    return response()->json($user->notifications);
});
Route::get('User_Notifications/{userId}', [UserNotification::class, 'userReservations']);
// End User Authorization


// Start Authentication For Admin , Doctor , User
// Admin Route
Route::prefix('admin')
    ->middleware('api')
    ->group(function () {
        Route::post('/login', [AuthAdminController::class, 'login'])->name('admin.login');
        Route::post('/register', [AuthAdminController::class, 'register'])->name('admin.register');
        Route::post('/logout', [AuthAdminController::class, 'logout'])->name('admin.logout');
        Route::get('/getaccount', [AuthAdminController::class, 'getAccount'])->name('admin.getAccount');
    });
// User Route
Route::prefix('user')
    ->middleware('api')
    ->group(function () {
        Route::post('/login', [AuthUserController::class, 'login'])->name('user.login');
        Route::post('/logout', [AuthUserController::class, 'logout'])->name('user.logout');
        Route::post('/register', [AuthUserController::class, 'register'])->name('user.register');
        Route::get('/getaccount', [AuthUserController::class, 'getAccount'])->name('user.getAccount');
    });
// Doctor Route
Route::prefix('doctor')
    ->middleware('api')
    ->group(function () {
        Route::post('/login', [AuthDoctorController::class, 'login'])->name('doctor.login');
        Route::post('/logout', [AuthDoctorController::class, 'logout'])->name('doctor.logout');
        Route::get('/getaccount', [AuthDoctorController::class, 'getAccount'])->name('doctor.getAccount');
    });
