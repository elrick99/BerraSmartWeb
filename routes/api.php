<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('driver/register', [\App\Http\Controllers\Api\AuthControllerDriver::class, 'register']);
Route::post('diver/login', [\App\Http\Controllers\Api\AuthControllerDriver::class, 'login']);


Route::middleware('auth:sanctum')->prefix('driver')->group(function () {
    //Ville
    Route::apiResource('ville', \App\Http\Controllers\Api\VilleControllerApi::class);

    //Commune
    Route::apiResource('commune', \App\Http\Controllers\Api\CommuneControllerApi::class);

    //Vehicule Marque
    Route::apiResource('vehicule-marque', \App\Http\Controllers\Api\VehiculeMarqueControllerApi::class);

    //Vehicule Type
    Route::apiResource('vehicule-type', \App\Http\Controllers\Api\VehiculeTypeControllerApi::class);

    //Driver
    Route::apiResource('driver', \App\Http\Controllers\Api\DriverControllerApi::class);

    //Driver Document
    Route::apiResource('driver-document', \App\Http\Controllers\Api\DriverDocumentControllerApi::class);
    Route::post('/logout', [\App\Http\Controllers\Api\AuthControllerDriver::class, 'logout']);
});
