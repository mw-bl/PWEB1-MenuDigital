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

Route::prefix('itens-cardapio')->group(function () {
    Route::get('/', [ItensCardapioController::class, 'index'])->name('itens_cardapio.index');
    Route::get('/create', [ItensCardapioController::class, 'create'])->name('itens_cardapio.create');
    Route::post('/', [ItensCardapioController::class, 'store'])->name('itens_cardapio.store');
    Route::get('/{id}', [ItensCardapioController::class, 'show'])->name('itens_cardapio.show');
    Route::get('/{id}/edit', [ItensCardapioController::class, 'edit'])->name('itens_cardapio.edit');
    Route::put('/{id}', [ItensCardapioController::class, 'update'])->name('itens_cardapio.update');
    Route::delete('/{id}', [ItensCardapioController::class, 'destroy'])->name('itens_cardapio.destroy');
});

