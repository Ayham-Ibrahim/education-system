<?php

use Illuminate\Support\Facades\Route;
use Modules\CourseManagement\Http\Controllers\CourseController;
use Modules\CourseManagement\Http\Controllers\SchoolClassController;
use Modules\CourseManagement\Http\Controllers\CourseManagementController;

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
//     Route::apiResource('coursemanagement', CourseManagementController::class)->names('coursemanagement');
// });


Route::middleware(['auth'])->group(function () {


    /*
    *  User Mangement routes 
    */
    Route::middleware(['admin'])->group(function () {
        Route::apiResource('courses', CourseController::class)->except(['index','show']);
        Route::post('add-subject/{course}',[CourseController::class,'addSubject']);


        Route::apiResource('classes', SchoolClassController::class)->except(['index','show']);
    });


    Route::get('courses',[CourseController::class,'index']);
    Route::get('courses/{course}',[CourseController::class,'show']);



    Route::get('classes',[SchoolClassController::class,'index']);
    Route::get('classes/{class}',[SchoolClassController::class,'show']);

});