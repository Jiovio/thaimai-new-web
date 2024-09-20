<?php

use App\Http\Controllers\EcregisterController;

Route::get('ecregisters', [EcregisterController::class, 'index']);
Route::get('ecregisters/{id}', [EcregisterController::class, 'show']);
Route::post('/ecregisters', [EcregisterController::class, 'store']);
Route::put('ecregisters/{id}', [EcregisterController::class, 'update']);
Route::delete('ecregisters/{id}', [EcregisterController::class, 'destroy']);
