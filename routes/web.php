<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\EstadosController;
use App\Http\Controllers\MunicipiosController;

Route::view('/register', 'auth.register')->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/cliente', [ClienteController::class, 'index'])->middleware('auth')->name('cliente.index');
Route::get('/cliente/create', [ClienteController::class, 'create'])->name('cliente.create');
Route::post('/cliente', [ClienteController::class, 'store'])->name('cliente.store');
Route::post('/cliente/{cliente}', [ClienteController::class, 'show'])->name('cliente.show');
Route::get('/cliente/{cliente}/edit', [ClienteController::class, 'edit'])->name('cliente.edit');
Route::put('/cliente/{cliente}', [ClienteController::class, 'update'])->name('cliente.update');
Route::delete('/cliente/{cliente}', [ClienteController::class, 'destroy'])->name('cliente.destroy');

Route::get('/contrato', [ContratoController::class, 'index'])->middleware('auth')->name('contrato.index');
Route::get('/contrato/create', [ContratoController::class, 'create'])->name('contrato.create');
Route::post('/contrato', [ContratoController::class, 'store'])->name('contrato.store');
Route::post('/contrato/{contrato}', [ContratoController::class, 'show'])->name('contrato.show');
Route::get('/contrato/{contrato}/edit', [ContratoController::class, 'edit'])->name('contrato.edit');
Route::put('/contrato/{contrato}', [ContratoController::class, 'update'])->name('contrato.update');
Route::delete('/contrato/{contrato}', [ContratoController::class, 'destroy'])->name('contrato.destroy');

Route::get('/municipios/{estadoId}', [MunicipiosController::class, 'buscarPorEstado'])->name('municipio.index');

Route::get('/home', function () {
    return view('home');
})->middleware('auth')->name('home');

// Route::get('/cliente', function () {
//     return view('cliente');
// })->middleware('auth')->name('cliente');
