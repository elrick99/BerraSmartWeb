<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/**
 * DRIVER
 */
Route::prefix('driver')->group(function () {

    Route::post('register', [\App\Http\Controllers\Api\AuthControllerDriver::class, 'registerDriver']);
    Route::post('login', [\App\Http\Controllers\Api\AuthControllerDriver::class, 'loginDriver']);
    Route::post('check', [\App\Http\Controllers\Api\AuthControllerDriver::class, 'checkDriver']);

    //Ville
    Route::apiResource('ville', \App\Http\Controllers\Api\VilleControllerApi::class);

    //Commune
    Route::apiResource('commune', \App\Http\Controllers\Api\CommuneControllerApi::class);

    //Vehicule Marque
    Route::apiResource('vehicule-marque', \App\Http\Controllers\Api\VehiculeMarqueControllerApi::class);

    //Vehicule Type
    Route::apiResource('vehicule-type', \App\Http\Controllers\Api\VehiculeTypeControllerApi::class);

    //Type Document Driver
    Route::apiResource('type-document', \App\Http\Controllers\Api\TypeDocumentDriverControllerApi::class);


    //Driver
    Route::apiResource('driver', \App\Http\Controllers\Api\DriverControllerApi::class)->middleware('auth:sanctum');

    //Driver Document
    Route::apiResource('driver-document', \App\Http\Controllers\Api\DriverDocumentControllerApi::class)->middleware('auth:sanctum');

    //Course
    Route::get('last-course-waiting', [\App\Http\Controllers\Api\CourseControllerApi::class, 'lastCourseWaiting'])->name('lastCourseWaiting')->middleware('auth:sanctum');

    Route::post('/logout', [\App\Http\Controllers\Api\AuthControllerDriver::class, 'logout']);
});



/**
 * User
 */
Route::prefix('user')->group(function () {
    Route::post('register', [\App\Http\Controllers\Api\AuthControllerDriver::class, 'registerUser']);
    Route::post('login', [\App\Http\Controllers\Api\AuthControllerDriver::class, 'loginUser']);
    Route::post('check', [\App\Http\Controllers\Api\AuthControllerDriver::class, 'checkUser']);

    //Course
    Route::apiResource('course', \App\Http\Controllers\Api\CourseControllerApi::class)->middleware('auth:sanctum');
});





