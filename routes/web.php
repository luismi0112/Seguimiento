<?php

use Illuminate\Support\Facades\Route;
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
    return view('dashboard');
})->name('home');

Route::resource('archivos', ArchivosController::class);
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
