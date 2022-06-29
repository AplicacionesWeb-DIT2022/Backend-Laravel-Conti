<?php

use Illuminate\Http\Request;

use App\Http\Controllers\Api\BicicletaController;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\EmpleadoController;
use App\Http\Controllers\Api\EquipamientoController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('/bicicleta', [BicicletaController::class, 'index']);
Route::get('/componente', [ComponenteController::class, 'index']);
Route::get('/cliente', [ClienteController::class, 'index']);
Route::get('/empleado', [EmpleadoController::class, 'index']);
Route::get('/equipamiento', [EquipamientoController::class, 'index']);