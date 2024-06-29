<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\RumahSakitController;

Route::middleware ( [ 'guest' ] )->group ( function ()
{
    Route::get ( 'login', [ AuthController::class, 'showLoginForm' ] )->name ( 'login' );
    Route::post ( 'login', [ AuthController::class, 'login' ] );
} );

Route::post ( 'logout', [ AuthController::class, 'logout' ] )->name ( 'logout' );

Route::get ( '/', function ()
{
    return redirect ()->route ( 'login' );
} );

Route::middleware ( [ 'auth' ] )->group ( function ()
{
    Route::get ( 'dashboard', function ()
    {
        return view ( 'dashboard' );
    } )->name ( 'dashboard' );

    Route::resource ( 'rumah_sakit', RumahSakitController::class);
    Route::resource ( 'pasien', PasienController::class);
    Route::get ( 'pasien/filter/{id}', [ PasienController::class, 'filter' ] )->name ( 'pasien.filter' );

    Route::get ( 'rumah_sakit/{id}/edit', [ RumahSakitController::class, 'edit' ] )->name ( 'rumah_sakit.edit' );
    Route::get ( 'rumah_sakit/{id}', [ RumahSakitController::class, 'show' ] )->name ( 'rumah_sakit.show' );
} );
