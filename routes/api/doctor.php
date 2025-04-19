<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{
    DoctorController,
    DoctorOfferController,
    DoctorOfferImageController,
    BlogController,
    AppointmentController,
    ReservationController,
    DoctorStatistics
};

Route::get('Doctor_Notifications/{doctorId}', [DoctorController::class, 'doctorReservations']);
Route::apiResource('Doctor_Offers', DoctorOfferController::class);
Route::apiResource('Doctor_Offer_Images', DoctorOfferImageController::class);
Route::apiResource('Blogs', BlogController::class);
Route::get('Blogs_Web', [BlogController::class, 'blogsWeb']);
Route::apiResource('Appointments', AppointmentController::class);
Route::middleware('auth:doctors')->prefix('doctor')->group(function () {
    Route::get('/reservations', [ReservationController::class, 'getDoctorReservations']);
    Route::get('/reservations/{id}', [ReservationController::class, 'getReservationById']);
    Route::put('/reservations/{reservationId}/confirm', [ReservationController::class, 'doctorConfirmReservation']);
    Route::put('/reservations/{reservationId}/cancel', [ReservationController::class, 'doctorCancelReservation']);
    Route::put('/reservations/{reservationId}/mark-as-visited', [ReservationController::class, 'markAsVisited']);
});
Route::get('doctor-statistics', [DoctorStatistics::class, 'getStatistics']);
