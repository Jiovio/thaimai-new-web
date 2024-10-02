<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Controllers\UserController;

//Route::put('/users/{userId}/otp', [UserController::class, 'updateOtp']);
Route::get('test', [UserController::class, 'loginOrRegister']);
Route::post('login-or-register', [UserController::class, 'loginOrRegister']);
Route::post('verify-otp', [UserController::class, 'verifyOtp']);
//Route::put('/users/{userId}/token', [AuthController::class, 'updateToken'])->middleware('auth:api');
Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
    return $request->user();
});

Route::post('/logout', function (Request $request) {
    $request->user()->currentAccessToken()->delete();

    return response()->json([
        'success' => true,
        'message' => 'Logout successful',
    ]);
})->middleware('auth:sanctum');