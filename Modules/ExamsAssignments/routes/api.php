<?php

use Illuminate\Support\Facades\Route;
use Modules\ExamsAssignments\Http\Controllers\ExamController;
use Modules\ExamsAssignments\Http\Controllers\ExamsAssignmentsController;

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
//     Route::apiResource('examsassignments', ExamsAssignmentsController::class)->names('examsassignments');
// });


Route::group(['middleware' => ['auth:api']], function () {

    // Route for submitting answers to an exam
    Route::post('/exams/{examId}/submit-answers', [ExamController::class, 'submitAnswers']);


    
});