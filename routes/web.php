<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/redirect', function () {
    if(Auth::user()->role == 'admin'){
        return redirect()->route('admin.dashboard');
    }elseif (Auth::user()->role == 'driver') {
        return redirect()->route('driver.dashboard');
    }else{
        return redirect('/');
    }
})->name('index.redirect');

/**
 * Admin routes
 */
Route::group(['prefix' => 'admin', 'middleware' => ['admin', 'auth']], function () {
   Route::get('/dashboard', function () {
       return view('backend.index');
   })->name('admin.dashboard');

   //Ville
   Route::resource('ville', App\Http\Controllers\Web\Admin\VilleController::class);

   //Commune
    Route::resource('commune', App\Http\Controllers\Web\Admin\CommuneController::class);

   //Type Document Driver
    Route::resource('type_document_driver', App\Http\Controllers\Web\Admin\TypeDocumentDriverController::class);

   //Marque Vehicule
    Route::resource('vehicule_marque', App\Http\Controllers\Web\Admin\VehiculeMarqueController::class);

    //Vehicule Type
    Route::resource('vehicule_type', App\Http\Controllers\Web\Admin\VehiculeTypeController::class);

    //Setting App
    Route::resource('setting-app', App\Http\Controllers\Web\Admin\SettingController::class);
})->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
]);



/**
 * Driver routes
 */
Route::group(['prefix' => 'driver', 'middleware' => ['admin', 'auth']], function () {
    Route::get('/dashboard', function () {
        return view('backend.index');
    });
 })->middleware([
     'auth:sanctum',
     config('jetstream.auth_session'),
     'verified',
 ]);
// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('backend.index');
//     })->name('dashboard');
// });
