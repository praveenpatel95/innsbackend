<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserPreferenceController;
Route::group(['prefix' => 'user', 'middleware' => 'auth:sanctum'], function () {
    Route::post('preference', [UserPreferenceController::class, 'storeOrUpdate']);
    Route::get('preference', [UserPreferenceController::class, 'get']);
});
