<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArchivosController;
use App\Http\Controllers\RegionalesController;
use App\Http\Controllers\AprendicesController;
use App\Http\Controllers\CentrosformacionController;
use App\Http\Controllers\EntecoformadoresController;
use App\Http\Controllers\EpsController;
use App\Http\Controllers\FichasdecaracterizacionController;
use App\Http\Controllers\InstructoresController;
use App\Http\Controllers\ProgramasformacionController;
use App\Http\Controllers\RolesadministrativosController;
use App\Http\Controllers\TiposdedocumentosController;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['verify' => true]);

Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])
    ->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::resource('archivos', archivosController::class);
    Route::resource('regionales', RegionalesController::class);
    Route::resource('aprendices', AprendicesController::class);
    Route::resource('centrosformacion', CentrosformacionController::class);
    Route::resource('entecoformadores', EntecoformadoresController::class);
    Route::resource('eps', EpsController::class);
    Route::resource('fichas', FichasdecaracterizacionController::class);
    Route::resource('instructores', InstructoresController::class);
    Route::resource('programasformacion', ProgramasformacionController::class);
    Route::resource('rolesadministrativos', RolesadministrativosController::class);
    Route::resource('tiposdocumentos', TiposdedocumentosController::class);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
        ->name('home');
});
