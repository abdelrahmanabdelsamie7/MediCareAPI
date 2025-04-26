<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthAdminController, AuthUserController, AuthDoctorController, GoogleAuthController
};

Route::prefix('admin')->middleware('api')->group(function () {
    Route::post('/login', [AuthAdminController::class, 'login']);
    Route::post('/register', [AuthAdminController::class, 'register']);
    Route::post('/logout', [AuthAdminController::class, 'logout']);
    Route::get('/getaccount', [AuthAdminController::class, 'getAccount']);
});

Route::prefix('user')->group(function () {
    Route::post('/login', [AuthUserController::class, 'login']);
    Route::post('/register', [AuthUserController::class, 'register']);
    Route::post('/auth/google', [GoogleAuthController::class, 'login']);
    Route::post('/password/forgot', [AuthUserController::class, 'forgotPassword']);
    Route::post('/password/reset', [AuthUserController::class, 'resetPassword']);
    Route::get('/verify-email/{token}', [AuthUserController::class, 'verifyEmail']);
    Route::post('/resend-email', [AuthUserController::class, 'resendVerification']);

    Route::middleware('auth:api')->group(function () {
        Route::get('/getaccount', [AuthUserController::class, 'getAccount']);
        Route::post('/logout', [AuthUserController::class, 'logout']);
        Route::delete('/account', [AuthUserController::class, 'deleteAccount']);
        Route::post('/profile', [AuthUserController::class, 'updateProfile']);
    });
});

Route::prefix('doctor')->middleware('api')->group(function () {
    Route::post('/login', [AuthDoctorController::class, 'login']);
    Route::post('/logout', [AuthDoctorController::class, 'logout']);
    Route::get('/getaccount', [AuthDoctorController::class, 'getAccount']);
});
