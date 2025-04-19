<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{
    UserPharmacyController, UserLaboratoryController, UserDoctorController,
    ReservationController, UserNotification, UserController
};

Route::apiResource('User_Pharmacy', UserPharmacyController::class);
Route::apiResource('User_Laboratory', UserLaboratoryController::class);
Route::apiResource('User_Doctor', UserDoctorController::class);

Route::prefix('reservations')->group(function () {
    Route::get('/available/{doctorId}/{day}', [ReservationController::class, 'getAvailableAppointments']);
    Route::post('/', [ReservationController::class, 'store']);
    Route::put('/{id}/confirm', [ReservationController::class, 'confirmReservation']);
    Route::put('/{id}/cancel', [ReservationController::class, 'cancelReservation']);
});

Route::middleware('auth:api')->group(function () {
    Route::get('/user/reservations', [ReservationController::class, 'getUserReservations']);
    Route::get('/user/progress', [UserController::class, 'getProgress']);
    Route::post('/user/redeem', [UserController::class, 'redeem']);
});

Route::get('/notifications', function () {
    $user = auth('api')->user();
    return response()->json($user->notifications);
});

Route::get('User_Notifications/{userId}', [UserNotification::class, 'userReservations']);