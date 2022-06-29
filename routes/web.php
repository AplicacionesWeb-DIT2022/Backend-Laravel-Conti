<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\BicicletaController;
use App\Http\Controllers\EquipamientoController;
// use App\Http\Controllers\NosotrosController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::resource('empleado', EmpleadoController::class)->middleware('auth');
Route::resource('cliente', ClienteController::class)->middleware('auth');
Route::resource('bicicleta', BicicletaController::class)->middleware('auth');
Route::resource('equipamiento', EquipamientoController::class)->middleware('auth');

Auth::routes(['register'=>false, 'reset'=>false] );

Route::get('/home', [EmpleadoController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [EmpleadoController::class, 'index'])->name('home');    
    Route::get('/cliente', [ClienteController::class, 'index']);
    Route::get('/bicicleta', [BicicletaController::class, 'index']);
    Route::get('/equipamiento', [EquipamientoController::class, 'index']);
}); 