<?php

use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CoinPairController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;

use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\SubscriptionController;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use App\Models\User;

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

Route::post('payment/initiate', [StripeController::class, 'initiatePayment']);
Route::post('payment/complete', [StripeController::class, 'completePayment']);
Route::post('payment/failure', [StripeController::class, 'failPayment']);
Route::get('get-intent', [StripeController::class, 'getIntent']);


Route::post('update-subscription-status', [StripeController::class, 'UpdateSubscriptionStatus']);
Route::post('cancel-subscription', [StripeController::class, 'cancelSubscription']);

Route::get('get-last-subscription', [StripeController::class, 'GetLastSubscription']);

// routes/web.php
Route::post('/create-payment', 'PayPalController@createPayment');
Route::post('/capture-payment', 'PayPalController@capturePayment');

Route::post('contact', [ContactController::class, 'store']);
Route::get('list-contacts', [ContactController::class, 'index']);

Route::post('reply-user', [ContactController::class, 'ReplyUser']);
Route::post('updateStatus', [ContactController::class, 'ContactUpdateStatus'])->name('updateStatus');

Route::get('users-update', [UserController::class, 'updateAdminStatus']);

Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::get('/checkInvite/{id}', 'checkInvite');
    Route::post('adminregister', 'Adminregister');
    Route::put('adminusers/{id?}', 'UpdateAdminregister');
    Route::post('sign-in', 'login');
    Route::get('verify/{code}/{id}', 'verify');
    Route::get('free-trial-check/{id}', 'FreeTrial');
    Route::post('forgot-password', 'forgotPassword');
    Route::post('reset-password', 'resetPassword');
    Route::delete('delete-user/{id}', 'delete');
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('user', [AuthController::class, 'user'])->name('user');

    Route::put('/user/update', [UserController::class, 'update']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('get-users', [AuthController::class, 'AllUser'])->name('get-users');

Route::get('all-pairs', [CoinPairController::class, 'allPairs'])->name('all-pairs');
Route::get('coin-price/{pair}', [CoinPairController::class, 'pairPrice'])->name('pairPrice');
Route::get('export', [ExportController::class, 'export'])->name('export');
Route::get('mobile-export', [ExportController::class, 'mobileExport'])->name('mobile-export');

Route::post('coupons', [DashboardController::class, 'store'])->name('coupons');
Route::post('send-promocode', [SubscriptionController::class, 'sendPromocode'])->name('send-promocode');

Route::get('get-coupons', [DashboardController::class, 'index'])->name('get-coupons');

Route::get('discount-show', [DashboardController::class, 'discountshowhomepage'])->name('discount-show');




Route::get('get-subscription-plans', [SubscriptionController::class, 'index'])->name('get-subscription-plans');
Route::post('save-subscription', [SubscriptionController::class, 'store'])->name('save-subscription');
Route::post('update-subscription', [SubscriptionController::class, 'update'])->name('update-subscription');
Route::get('user-subscription-plan', [SubscriptionController::class, 'UserSubscription']);






Route::get('receipt-export', [ExportController::class, 'ReceiptExport'])->name('receipt-export');


Route::delete('delete-subscription/{id}', [SubscriptionController::class, 'delete'])->name('delete-subscription');
Route::post('get-promocode', [SubscriptionController::class, 'GetPromocode'])->name('get-promocode');


Route::post('update-coupons', [DashboardController::class, 'update'])->name('update-coupons');

Route::post('save-coupon', [SettingsController::class, 'saveCoupon'])->name('save-coupon');
Route::post('update-setting', [SettingsController::class, 'UpdateSetting'])->name('update-setting');


Route::post('invite-user', [SettingsController::class, 'InviteUser'])->name('invite-user');


Route::get('coupon-settings', [SettingsController::class, 'CouponSettings'])->name('coupon-settings');


Route::delete('delete-coupons/{id}', [DashboardController::class, 'delete'])->name('delete-coupons');


Route::get('get-stripe-intent', function () {

    // Find the user by ID (Assuming you want to get a specific user, e.g., User with ID 1)
    $user = User::get();

    if ($user) {
        // Make hidden attributes visible
        $user->makeVisible(['verification_code']);

        // Perform the payment
        // $payment = $user->pay('400');

        // Convert user data to an array
        $userData = $user->toArray();

        // Return response with user data and payment intent client secret
        return response()->json(['user' => $userData]);
    } else {
        // User not found, return an error response
        return response()->json(['error' => 'User not found'], 404);
    }
});




// Route::get('coupon/create', 'DashboardController@create')->name('coupon.create');