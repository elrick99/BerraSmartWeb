<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('driver/register', [\App\Http\Controllers\Api\AuthControllerDriver::class, 'register']);
Route::post('driver/login', [\App\Http\Controllers\Api\AuthControllerDriver::class, 'login']);
Route::post('driver/check', [\App\Http\Controllers\Api\AuthControllerDriver::class, 'checkDriver']);

//Ville
Route::apiResource('driver/ville', \App\Http\Controllers\Api\VilleControllerApi::class);
//Commune
Route::apiResource('driver/commune', \App\Http\Controllers\Api\CommuneControllerApi::class);

//Vehicule Marque
Route::apiResource('driver/vehicule-marque', \App\Http\Controllers\Api\VehiculeMarqueControllerApi::class);

//Vehicule Type
Route::apiResource('driver/vehicule-type', \App\Http\Controllers\Api\VehiculeTypeControllerApi::class);

//Type Document Driver
Route::apiResource('driver/type-document', \App\Http\Controllers\Api\TypeDocumentDriverControllerApi::class);


Route::middleware('auth:sanctum')->prefix('driver')->group(function () {

    //Driver
    Route::apiResource('driver', \App\Http\Controllers\Api\DriverControllerApi::class);

    //Driver Document
    Route::apiResource('driver-document', \App\Http\Controllers\Api\DriverDocumentControllerApi::class);
    Route::post('/logout', [\App\Http\Controllers\Api\AuthControllerDriver::class, 'logout']);
});
