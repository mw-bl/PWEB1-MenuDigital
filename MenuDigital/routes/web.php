<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\EmpresaController;

Route::get('/empresa/cadastro', [EmpresaController::class, 'cadastro'])->name('empresa.cadastro');
Route::post('/empresas', [EmpresaController::class, 'store'])->name('empresa.store');

Route::get('/empresa/login', [EmpresaController::class, 'loginForm'])->name('empresa.loginForm');
Route::post('/empresa/login', [EmpresaController::class, 'login'])->name('empresa.login');

use App\Http\Controllers\CardapioController;
use App\Http\Controllers\ItensCardapioController;

Route::prefix('cardapio')->group(function () {
    Route::get('/', [CardapioController::class, 'index'])->name('cardapio.index');
    Route::get('/create', [CardapioController::class, 'create'])->name('cardapio.create');
    Route::post('/', [CardapioController::class, 'store'])->name('cardapio.store');
    Route::get('/{id}', [CardapioController::class, 'show'])->name('cardapio.show');
    Route::get('/{id}/edit', [CardapioController::class, 'edit'])->name('cardapio.edit');
    Route::put('/{id}', [CardapioController::class, 'update'])->name('cardapio.update');
    Route::delete('/{id}', [CardapioController::class, 'destroy'])->name('cardapio.destroy');
});

