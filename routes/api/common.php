<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AiAnalysisController, PrescriptionController, MedicineController,
    LabTestController, PaymentController
};
use App\Http\Controllers\API\{
    ReservationController
};

Route::post('/ai-analysis', [AiAnalysisController::class, 'analyze'])->name('ai.analysis');
Route::post('/analyze/prescription', [PrescriptionController::class, 'analyze']);
Route::get('/medicine-details/{name}', [MedicineController::class, 'getDetails']);
Route::post('/lab-test-analyzer', [LabTestController::class, 'analyze']);
Route::post('/payment', [PaymentController::class, 'handlePayment']);
Route::post('/payment/update', [PaymentController::class, 'updatePaymentStatus']);

Route::middleware(['auth:api,doctors'])->group(function () {
    Route::patch('notifications/{notificationId}/read', [ReservationController::class, 'markNotificationAsRead']);
});
