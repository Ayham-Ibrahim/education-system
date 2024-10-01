<?php

use Illuminate\Support\Facades\Route;
use Modules\UserManagement\Http\Controllers\AuthController;
use Modules\UserManagement\Http\Controllers\UserManagementController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

// Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
//     Route::apiResource('usermanagement', UserManagementController::class)->names('usermanagement');
// });


/**
     * Auth Routes
     *
     * These routes handle user authentication, including login, registration, and logout.
    */
    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('logout', 'logout')->middleware('auth:api');
    });

    Route::middleware(['auth'])->group(function () {


        /*
        *  User Mangement routes 
        */
        Route::middleware(['admin'])->group(function () {
            Route::apiResource('users', UserManagementController::class)->except(['index','show']);
        });
        Route::get('users',[UserManagementController::class,'index']);
        Route::get('users/{user}',[UserManagementController::class,'show']);
    
    });
